<?php

use Illuminate\Support\Facades\Route;
use Laravel\Telescope\Telescope;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;
use App\Http\Controllers\TempUploadController;




//Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
use \App\Http\Middleware\RedirectIfAuthenticated;
|
*/
/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/user/profile');  // Redirect to /user/profile if logged in
    }

    return view('welcome');  // Show the welcome page if not authenticated
});




Route::get('/', function () {
    return view('welcome');
})->name('welcome');



/*Route::controller(ProfileController::class)->group(function(){
    Route::get('/profiles','index')->name('profiles.index');
    use Laravel\Telescope\Telescope;//i have added this on 13 october
    Route::get('/profiles/create','create')->name('profiles.create');
    Route::post('/profiles','store')->name('profiles.store');
    Route::get('/profiles/edit/{id}', 'edit')->name('profiles.edit');
    Route::get('/profiles/edit/{profileId}', 'edit')->name('profiles.edit');
   
    Route::delete('/profiles/{profile}','destroy')->name('profiles.destroy');  

    Route::get('/profiles/search', 'search')->name('profiles.search');
    Route::get('/profile','getData');
    

    Route::get('/profiles/fetch', 'fetchProfiles')->name('profiles.fetchProfiles');
});*/

//Route::get('list',[AddressController::class,'show']);
/*Route::view('add','addaddress');
Route::post('add',[AddressController::class,'addData']);

Route::get('delete/{id}',[AddressController::class,'delete']);
Route::get('edit/{id}',[AddressController::class,'editData']);
Route::post('edit',[AddressController::class,'update']);*/
/*Route::middleware(['auth'])->group(function () {
    Route::get('/add', [AddressController::class, 'add'])->name('addresses.add');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');

    
    Route::get('get-states', [AddressController::class, 'getStates'])->name('get.states');
    Route::get('get-cities', [AddressController::class, 'getCities'])->name('get.cities');
   // Route::get('list',[AddressController::class,'show']);
    Route::get('delete/{id}',[AddressController::class,'delete']);
    //Route::get('addresses/update',[AddressController::class,'update']);
   // Route::post('edit',[AddressController::class,'update']);
    // Route for displaying the Edit form
Route::get('/addresses/{id}/edit', [AddressController::class, 'edit'])->name('addresses.edit');

// Route for updating the address
Route::get('/edit/{id}', [AddressController::class, 'edit'])->name('addresses.edit');
Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



//Route::get('/users', [UserController::class, 'index'])->name('users.index');

/*Route::get('/usersaddresses', [UserController::class, 'getData']);
Route::get('search', [UserController::class, 'search']);
Route::get('list',[AddressController::class,'show']);
Route::get('/addresses', [AddressController::class, 'show'])->name('addresses.list');
Route::get('/admin/dashboard', [UserController::class, 'page']);*/
Route::post('/upload-temp', [TempUploadController::class, 'store'])->name('upload.temp');
Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
Route::get('/add', [AddressController::class, 'add'])->name('addresses.add');
Route::get('get-states', [AddressController::class, 'getStates'])->name('get.states');
    Route::get('get-cities', [AddressController::class, 'getCities'])->name('get.cities');
  

Route::middleware(['auth', 'admin'])->group(function () {
   
    Route::get('/usersaddresses', [UserController::class, 'getData']);
   // Route::get('/add', [AddressController::class, 'add'])->name('addresses.add');
   // Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('delete/{id}',[AddressController::class,'delete']);
   // Route::get('/addresses/{id}/edit', [AddressController::class, 'edit'])->name('addressess.edit');
    // Route for updating the address
    Route::get('/edit/{id}', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
   // Route::get('get-states', [AddressController::class, 'getStates'])->name('get.states');
   // Route::get('get-cities', [AddressController::class, 'getCities'])->name('get.cities');
    Route::get('search', [UserController::class, 'search'])->name('users.search');
    Route::get('list',[AddressController::class,'index'])->name('addresses.list');
    //Route::get('/addresses', [AddressController::class, 'show'])->name('addresses.list');
  // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/dashboard', [AdminController::class, 'page'])->name('admin.dashboard');
   // Route::get('/admin/details', [AdminController::class, 'show'])->name('admin.details');
});

//Route::get('/admin/dashboard', [UserController::class, 'page']);
/*Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/admin/dashboard', [UserController::class, 'page'])->name('admin.dashboard');
});*/
/*Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'page'])
         ->middleware('admin')
         ->name('admin.dashboard');
});*/


