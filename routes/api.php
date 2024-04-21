<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
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
    Route::get("logout", [AuthController::class, "logout"]);
});

Route::get("data", [CrudController::class, "index"]);
Route::get("data/{id}", [CrudController::class, "show"]);
Route::post("data", [CrudController::class, "create"]);

Route::put("data/{id}", [CrudController::class, "update"]);
Route::delete("data/{id}", [CrudController::class, "destroy"]);
