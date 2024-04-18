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
            "middle_name" => "required",
            "last_name" => "required",
            "date_of_birth" => "required",
            "address" => "required",
            "contact_number" => "required",
            "gender" => "required",
            "marital_status" => "required",
            "id_proof" => "nullable",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"
        ]);

        $user = User::create([
            "first_name" => $fields["first_name"],
            "middle_name" => $fields["middle_name"],
            "last_name" => $fields["last_name"],
            "date_of_birth" => $fields["date_of_birth"],
            "address" => $fields["address"],
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

    function login(Request $request) {
        $fields = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", $fields["email"])->first();

        if (!$user) {
            return response()->json([
                "message" => "Email does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $token = $user->createToken("secret")->plainTextToken;

        return response()->json([
            "message" => "Logged in successfully",
            "user" => $user,
            "token" => $token
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "Logged out"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}