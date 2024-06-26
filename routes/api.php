<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;


// Authentication
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

//User
Route::get("/users", [UserController::class, "getUsers"]);
Route::get("/users/{id}", [UserController::class, "getUser"]);

// Test Protected Routes 

Route::group(["middleware" => ["auth:sanctum"]], function() {


//Term
Route::get("/terms", [TermController::class, "getTerms"]);
Route::get("/terms/{id}", [TermController::class, "getTerm"]);
Route::get("/terms/{title}", [TermController::class, "getTermTitle"]);
Route::post("/terms", [TermController::class, "setTerm"]);
Route::put("/terms/{id}", [TermController::class, "updateTerm"]);
Route::delete("/terms/{id}", [TermController::class, "deleteTerm"]);

//Service
Route::get("/services", [ServiceController::class, "getServices"]);
Route::get("/services/{id}", [ServiceController::class, "getService"]);
Route::post("/services", [ServiceController::class, "setService"]);
Route::put("/services/{id}", [ServiceController::class, "updateService"]);
Route::delete("/services/{id}", [ServiceController::class, "deleteService"]);

//Booking
Route::get("/bookings", [BookingController::class, "getBookings"]);
Route::get("/bookings/{id}", [BookingController::class, "getBooking"]);
Route::post("/bookings", [BookingController::class, "setBooking"]);
Route::put("/bookings/{id}", [BookingController::class, "updateBooking"]);
Route::delete("/bookings/{id}", [BookingController::class, "deleteBooking"]);

//update User

//Route::get("/users/{user_role}", [UserController::class, "getUserRole"]);
Route::put("/users/{id}", [UserController::class, "updateUser"]);
Route::delete("/users/{id}", [UserController::class, "deleteUser"]);


// Upload
Route::post("/upload-image", [UploadController::class, "uploadImage"]);

Route::post("/logout", [AuthController::class, "logout"]);


});