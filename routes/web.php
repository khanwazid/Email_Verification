<?php

use Illuminate\Support\Facades\Route;
use Laravel\Telescope\Telescope;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;
use App\Http\Controllers\TempUploadController;






Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/user/profile');  // Redirect to /user/profile if logged in
    }

    return view('welcome');  // Show the welcome page if not authenticated
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
Route::middleware('auth')->group(function () {
    Route::get('/add', [AddressController::class, 'add'])->name('addresses.add');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
});



Route::post('/upload-temp', [TempUploadController::class, 'store'])
    ->name('upload.temp')
    ->middleware('guest');


Route::get('get-states', [AddressController::class, 'getStates'])->name('get.states');
Route::get('get-cities', [AddressController::class, 'getCities'])->name('get.cities');
  

Route::middleware(['auth', 'admin'])->group(function () {
   
    Route::get('/usersaddresses', [UserController::class, 'getData']);
    Route::get('delete/{id}',[AddressController::class,'delete']);
  
    // Route for updating the address
    Route::get('/edit/{id}', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
    Route::get('search', [UserController::class, 'search'])->name('users.search');
    Route::get('list',[AddressController::class,'index'])->name('addresses.list');
    Route::get('/admin/dashboard', [AdminController::class, 'page'])->name('admin.dashboard');
  
});




