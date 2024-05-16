<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\TruckScheduleController;
use App\Http\Controllers\TypeTruckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', [AuthController::class, 'index']);

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
// Route::get("profile", [AuthController::class, "profile"]);

Route::group([
    "middleware" => ["auth:api"],
], function () {

    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh", [AuthController::class, "refreshToken"]);
    Route::delete("logout", [AuthController::class, "logout"]);
});

Route::get("data", [TruckController::class, "index"]);
Route::get("data/{id}", [TruckController::class, "show"]);
Route::post("data", [TruckController::class, "create"]);
Route::put("data/{id}", [TruckController::class, "update"]);
Route::delete("data/{id}", [TruckController::class, "destroy"]);

Route::get("truck_schedule", [TruckScheduleController::class, "index"]);
Route::get("truck_schedule/{id}", [TruckScheduleController::class, "show"]);
Route::post("truck_schedule", [TruckScheduleController::class, "create"]);
Route::put("truck_schedule/{id}", [TruckScheduleController::class, "update"]);
Route::delete("truck_schedule/{id}", [TruckScheduleController::class, "destroy"]);

Route::get("delivery_schedule", [DeliveryController::class, "index"]);
Route::get("delivery_schedule/{id}", [DeliveryController::class, "show"]);
Route::post("delivery_schedule", [DeliveryController::class, "create"]);
Route::put("delivery_schedule/{id}", [DeliveryController::class, "update"]);
Route::delete("delivery_schedule/{id}", [DeliveryController::class, "destroy"]);

Route::get("drivers", [DriverController::class, "index"]);
Route::get("drivers/{id}", [DriverController::class, "show"]);
Route::post("drivers", [DriverController::class, "create"]);
Route::put("driversStatus/{id}", [DriverController::class, "updateStatus"]);
Route::put("drivers/{id}", [DriverController::class, "update"]);
Route::delete("drivers/{id}", [DriverController::class, "destroy"]);

Route::get("typeTruck", [TypeTruckController::class, "index"]);

Route::get("generate-pdf/{id}", [PdfController::class, "generate_pdf"]);