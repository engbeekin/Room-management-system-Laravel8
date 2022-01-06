<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomersController;
use App\Models\Booking;
use App\Models\Customers;
use App\Models\Rooms;
use GuzzleHttp\Middleware;

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

    $rooms=Rooms::count();
    $customers=Customers::count();
    $bookings=Booking::count();
    return view('dashboard',compact('rooms','customers','bookings'));
});







//  Users Routes
// Route::get('/users',[RegisterController::class,'index'])->name('users');
// Route::get('/user/create',[RegisterController::class,'addUser'])->name('user.create');
// Route::post('/user/create',[RegisterController::class,'store'])->name('user.store');
Auth::routes([
     'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth']],function(){

    // Rooms Routes
    Route::resource('/rooms',RoomsController::class);
    Route::get('/room/delete/{id}',[RoomsController::class,'destroy'] )->name('rooms.destroy');

    //Customoers Routes
    Route::resource('/customers',CustomersController::class);
Route::get('/customers/delete/{id}',[CustomersController::class,'destroy'] )->name('customer.delete');

// Booking Routes
       Route::resource('/booking',BookingController::class);
// booking filtering Route
    Route::get('booking/available-rooms/{checkin_date}',[BookingController::class,'available_rooms']);

    // users Route
//    Route::get('/users',[RegisterController::class,'index'])->name('users');
});
