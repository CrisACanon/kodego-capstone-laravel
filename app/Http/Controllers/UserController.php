<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function getUsers() {
        $users = UserResource::collection(User::all());
        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }

    public function getUser($id) {
        $user = new UserResource(User::find($id));
        return response()->json($user, 200, [], JSON_PRETTY_PRINT);
    }

    public function getUserRole($role) {
      
        $users = User::where("user_role", $role )->get();
        return response()->json($users, 200, [], JSON_PRETTY_PRINT);

    }

    public function updateUser(Request $request) {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            return response()->json([
                "message" => "User does not exist"
            ], 404);
        }

        $fields = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "date_of_birth" => "required",
            "detailed_address" => "required",
            "province" => "required",
            "city_municipality" => "required",
            "contact_number" => "required",
            "gender" => "required",
            "marital_status" => "required",
            "email" => "required|email",
            "id_proof" => "nullable"
        ]);

        $user->first_name = $fields["first_name"];
        $user->last_name = $fields["last_name"];
        $user->date_of_birth = $fields["date_of_birth"];
        $user->detailed_address = $fields["detailed_address"];
        $user->city_municipality = $fields["city_municipality"];
        $user->province = $fields["province"];
        $user->contact_number = $fields["contact_number"];
        $user->gender = $fields["gender"];
        $user->marital_status = $fields["marital_status"];
        $user->email = $fields["email"];
        $user->id_proof = $fields["id_proof"];
        $user->save();

        return response()->json([
            "message" => "User has been updated",
            "data" => $user
        ], 200, [], JSON_PRETTY_PRINT);
    }
    
    function deleteUser($id) {
        $user = User::where("id", $id)->first();
        if (!$user) {
            return response()->json([
                "message" => "User profile does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $user->delete();
        return response()->json([
            "message" => "User profile has been deleted"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}