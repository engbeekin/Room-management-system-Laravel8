<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomersController;

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

Route::get('/rooms',[RoomsController::class,'index'] )->name('room');

Route::get('/fetchrooms',[RoomsController::class,'allRooms'] );
Route::get('/room/create',[RoomsController::class,'create'] )->name('room.create');

Route::post('/room/store',[RoomsController::class,'store'] )->name('room.store');
Route::get('/room/edit/{id}',[RoomsController::class,'edit'] )->name('room.edit');
Route::post('/room/update/{id}',[RoomsController::class,'update'] )->name('room.update');
Route::get('/room/delete/{id}',[RoomsController::class,'destroy'] )->name('room.delete');



Route::get('/customers',[CustomersController::class,'index'] )->name('customer');
Route::get('/customers/create',[CustomersController::class,'create'] )->name('customer.create');

Route::post('/customers/store',[CustomersController::class,'store'] )->name('customer.store');
Route::get('/allcustomers',[CustomersController::class,'allCustomers'] );
Route::get('/customers/edit/{id}',[CustomersController::class,'edit'] )->name('customer.edit');
Route::post('/customers/update/{id}',[CustomersController::class,'update'] )->name('customer.update');
Route::get('/customers/delete/{id}',[CustomersController::class,'destroy'] )->name('customer.delete');

Route::get('/bookedrooms',[BookingController::class,'index'] );

Route::get('/booking/create',[BookingController::class,'create'] )->name('booking.create');
Route::post('/booking/store',[BookingController::class,'store'] )->name('booking.store');
// Route::get('/booking/{id}',[BookingController::class,'edit'] )->name('booking.edit');
// Route::post('/booking/{id}',[BookingController::class,'store'] )->name('booking.store');
Route::get('booking/available-rooms/{checkin_date}',[BookingController::class,'available_rooms']);

//  Users Routes
Route::get('/users',[RegisterController::class,'index'])->name('users');
Route::get('/user/create',[RegisterController::class,'addUser'])->name('user.create');
Route::post('/user/create',[RegisterController::class,'store'])->name('user.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
