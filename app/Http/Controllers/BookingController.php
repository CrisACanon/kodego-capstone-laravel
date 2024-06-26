<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Resources\BookingResource;

class BookingController extends Controller
{
    public function getBookings() {
        $bookings = BookingResource::collection(Booking::all());
        return response()->json($bookings, 200, [], JSON_PRETTY_PRINT);
    }

    public function getBooking($id) {
        $booking = new BookingResource(Booking::find($id));
        return response()->json($booking, 200, [], JSON_PRETTY_PRINT);
    }

    function setBooking(Request $request) {
        $fields = $request->validate([
            "service_id" => "required",
            "term_id" => "required",
            "start_date" => "required",
            "start_time" => "required",
            "remarks" => "nullable",
            "message" => "nullable",
            "emp_id" => "nullable",
            
 
        ]);

        $booking = Booking::create([
            "emp_id" => $fields["emp_id"],
            "service_id" => $fields["service_id"],
            "term_id" => $fields["term_id"],
            "start_date" => $fields["start_date"],
            "start_time" => $fields["start_time"],
            "remarks" => $fields["remarks"],
            "message" => $fields["message"],
            "cust_id" => auth()->user()->id
        ]);

        return response()->json([
            "message" => "Booking has been created",
            "data" => $booking
        ], 201, [], JSON_PRETTY_PRINT);
    }

    function updateBooking(Request $request, $id) {
        $booking = Booking::where("id", $id)->first();

        if (!$booking) {
            return response()->json([
                "message" => "Booking does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }
        
        $fields = $request->validate([
            "emp_id" => "required",
            "service_id" => "required",
            "term_id" => "required",
            "status" => "required",
            "start_date" => "required",
            "start_time" => "required",
            "message" => "nullable",
            "remarks" => "nullable",
        ]);

        $booking->emp_id = $fields["emp_id"];
        $booking->service_id = $fields["service_id"];
        $booking->term_id = $fields["term_id"];
        $booking->status = $fields["status"];
        $booking->start_date = $fields["start_date"];
        $booking->start_time = $fields["start_time"];
        $booking->message = $fields["message"];
        $booking->remarks = $fields["remarks"];
        $booking->save();

        return response()->json([
            "message" => "Booking has been updated",
            "data" => $booking
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function deleteBooking($id) {
        $booking = Booking::where("id", $id)->first();

        if (!$booking) {
            return response()->json([
                "message" => "Booking does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $booking->delete();
        return response()->json([
            "message" => "Booking has been deleted"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}