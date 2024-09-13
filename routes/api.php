<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::get("/users/{userId}/addresses", [AddressController::class, "get"]);
Route::post("/users/{userId}/addresses", [AddressController::class, "post"]);
Route::put("/users/{userId}/addresses", [AddressController::class, "put"]);
Route::delete("/users/{userId}/addresses", [AddressController::class, "delete"]);