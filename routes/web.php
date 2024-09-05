<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('/profiles','index')->name('profiles.index');
    Route::get('/profiles/create','create')->name('profiles.create');
    Route::post('/profiles','store')->name('profiles.store');
    Route::get('/profiles/{profile}/edit','edit')->name('profiles.edit');
    Route::put('/profiles/{profile}','update')->name('profiles.update');
    Route::delete('/profiles/{profile}','destroy')->name('profiles.destroy');    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



