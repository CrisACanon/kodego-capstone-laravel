<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
//use App\Http\Resources\TaskResource;

class BookingController extends Controller
{
    function getBookings(Request $request) {
        $bookings = Booking::where("cust_id", auth()->user()->id)->paginate(5);
        return response()->json($bookings, 200, [], JSON_PRETTY_PRINT);
    }

    function getBooking($id) {
        $booking = Booking::where("id", $id)->first();
        return response()->json($booking, 200, [], JSON_PRETTY_PRINT);
    }

    function setBooking(Request $request) {
        $fields = $request->validate([
            "service_id" => "required",
            "term_id" => "required",
            "remarks" => "nullable",
            "emp_id" => "nullable",
            
 
        ]);

        $booking = Booking::create([
            "emp_id" => $fields["emp_id"],
            "service_id" => $fields["service_id"],
            "term_id" => $fields["term_id"],
            "remarks" => $fields["remarks"],
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
            "remarks" => "nullable",
        ]);

        $booking->emp_id = $fields["emp_id"];
        $booking->service_id = $fields["service_id"];
        $booking->term_id = $fields["term_id"];
        $booking->status = $fields["status"];
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