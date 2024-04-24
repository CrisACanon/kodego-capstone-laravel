<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    function register(Request $request) {
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
            "id_proof" => "nullable",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"

        ]);

        $user = User::create([
            "first_name" => $fields["first_name"],
            "last_name" => $fields["last_name"],
            "date_of_birth" => $fields["date_of_birth"],
            "detailed_address" => $fields["detailed_address"],
            "province" => $fields["province"],
            "city_municipality" => $fields["city_municipality"],
            "contact_number" => $fields["contact_number"],
            "gender" => $fields["gender"],
            "marital_status" => $fields["marital_status"],
            "id_proof" => $fields["id_proof"],
            "email" => $fields["email"],
            "password" => Hash::make($fields["password"])
        ]);

        $token = $user->createToken("secret")->plainTextToken;

        return response()->json([
            "message" => "User has been registered",
            "user" => $user,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", $fields["email"])->first();

        if (!$user) {
            return response()->json([
                "message" => "Email address does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $token = $user->createToken(env("AUTH_SECRET", "secret"))->plainTextToken;

        return response()->json([
            "message" => "Logged in successfully",
            "user" => $user,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "Logged out"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}