<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\WelcomeController;


//Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

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



/*Route::controller(ProfileController::class)->group(function(){
    Route::get('/profiles','index')->name('profiles.index');
    Route::get('/profiles/create','create')->name('profiles.create');
    Route::post('/profiles','store')->name('profiles.store');
    Route::get('/profiles/edit/{id}', 'edit')->name('profiles.edit');
    Route::get('/profiles/edit/{profileId}', 'edit')->name('profiles.edit');
   
    Route::delete('/profiles/{profile}','destroy')->name('profiles.destroy');  

    Route::get('/profiles/search', 'search')->name('profiles.search');
    Route::get('/profile','getData');
    

    Route::get('/profiles/fetch', 'fetchProfiles')->name('profiles.fetchProfiles');
});*/

Route::get('list',[AddressController::class,'show']);
Route::view('add','addaddress');
Route::post('add',[AddressController::class,'addData']);

Route::get('delete/{id}',[AddressController::class,'delete']);
Route::get('edit/{id}',[AddressController::class,'editData']);
Route::post('edit',[AddressController::class,'update']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/usersaddresses', [UserController::class, 'getData']);
Route::get('search', [UserController::class, 'search']);
  

