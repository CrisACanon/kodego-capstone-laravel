<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    public function getServices() {
        $services = ServiceResource::collection(Service::all());
        return response()->json($services, 200, [], JSON_PRETTY_PRINT);
    }

    public function getService($id) {
        $service = new ServiceResource(Service::find($id));
        return response()->json($service, 200, [], JSON_PRETTY_PRINT);
    }

    function setService(Request $request) {
        $fields = $request->validate([
            "title" => "required",
            "description" => "required",
            "rate" => "required",
            "service_category" => "required",
            "image" => "nullable"
        ]);

        $service = Service::create([
            "title" => $fields["title"],
            "description" => $fields["description"],
            "rate" => $fields["rate"],
            "service_category" => $fields["service_category"],
            "image" => $fields["image"],
            "user_id" => auth()->user()->id
        ]);

        return response()->json([
            "message" => "Service has been created",
            "data" => $service
        ], 201, [], JSON_PRETTY_PRINT);
    }

    function updateService(Request $request, $id) {
        $service = Service::where("id", $id)->first();

        if (!$service) {
            return response()->json([
                "message" => "Service does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }
        
        $fields = $request->validate([
            "title" => "required",
            "description" => "required",
            "rate" => "required",
            "service_category" => "required",
            "image" => "nullable"
        ]);

        $service->title = $fields["title"];
        $service->description = $fields["description"];
        $service->rate = $fields["rate"];
        $service->service_category = $fields["service_category"];
        $service->image = $fields["image"];
        $service->save();

        return response()->json([
            "message" => "Service has been updated",
            "data" => $service
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function deleteTask($id) {
        $service = Service::where("id", $id)->first();

        if (!$service) {
            return response()->json([
                "message" => "Service does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $service->delete();
        return response()->json([
            "message" => "Service has been deleted"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}