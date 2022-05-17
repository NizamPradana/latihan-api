<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConsultationController;
use App\Http\Controllers\API\VaccinationController;
use App\Http\Controllers\API\VaccineSpotController;
use App\Http\Controllers\API\RegionController;
use App\Models\User;
use App\Models\Vaccination;
use App\Models\VaccineSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/v1/auth/register", [AuthController::class , "register"]);

Route::post("/v1/auth/login", [AuthController::class , "login"]);

Route::group(["middleware" => "auth:sanctum"] , function(){

    Route::post("/v1/auth/logout", [AuthController::class , "logout"]);

    // Route::get("/all", function(){
    //     return User::with("regional")->get();
    // });

    Route::get("/v1/user", function(Request $request){
        return $request->user();
    });

    Route::get("/v1/spots", function(){
        return VaccineSpot::all();
    });

    Route::post("/v1/spot/create", [VaccineSpotController::class ,"store"]);

    Route::get("/v1/spot", [VaccineSpotController::class ,"showNearest"]);

    Route::get("/v1/spot/{id}", [VaccineSpotController::class ,"show"]);

    Route::resource("/v1/consultation", ConsultationController::class);

    Route::get("/v1/vaccination", [VaccinationController::class, "index"]);

    Route::get("/v1/vaccination/{id_user}", [VaccinationController::class, "show"]);

    

});

Route::get('/login', function(){
    return response()->json([
        "message" => "Login First!"
    ], 500);
})->name('login');

Route::get("/v1/region", [RegionController::class , "index"]);

Route::post("/v1/region", [RegionController::class , "store"]);

// Route::get("/test", function(){
//     return User::all();
// });