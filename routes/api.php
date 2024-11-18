<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\UserController;
use Laravel\Telescope\Telescope;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;
use App\Http\Controllers\TempUploadController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->put('/users/profile', [ProfileController::class, 'updateProfile']);
/*Route::middleware('auth:sanctum')->post('/addresses', [AddressController::class, 'store']);
Route::middleware('auth:sanctum')->put('/addresses/{id}', [AddressController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/addresses/{id}', [AddressController::class, 'destroy']);
Route::middleware('auth:sanctum')->post('/users/profile', [ProfileController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->get('/user/profile', [ProfileController::class, 'showProfileWithAddresses']);
Route::middleware('auth:sanctum')->get('/user/addresses', [AddressController::class, 'getUserAddresses']);*/
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware(['throttle:location'])->group(function () {
    Route::get('/countries', [LocationController::class, 'countries']);
    Route::get('/states/{country}', [LocationController::class, 'states']);
    Route::get('/cities/{state}', [LocationController::class, 'cities']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    //Route::middleware('auth:sanctum')->put('/users/profile', [ProfileController::class, 'updateProfile']);
Route::post('/addresses', [AddressController::class, 'store']);
Route::get('addresses/search', [AddressController::class, 'search']);
Route::put('/addresses/{id}', [AddressController::class, 'update']);
Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);
Route::post('/users/profile', [ProfileController::class, 'updateProfile']);
Route::get('/user/profile', [ProfileController::class, 'showProfileWithAddresses']);
Route::get('/user/addresses', [AddressController::class, 'getUserAddresses']);

    
    // Profile routes
  /*  Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);

    // Address routes
    Route::get('addresses', [AddressController::class, 'index']);
    Route::post('addresses', [AddressController::class, 'store']);
    Route::put('addresses/{id}', [AddressController::class, 'update']);
    Route::delete('addresses/{id}', [AddressController::class, 'destroy']);*/
});
/*
Route::get("/test" , function(){
    return ["name"=>"wazid khan", 'channel'=>"jdhdh"];
});*/