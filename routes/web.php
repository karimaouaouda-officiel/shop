<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestController;

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

Route::controller(GuestController::class)->group(function(){
    Route::get('/' , 'index'); // Routing for new visiter (not logged in)
    //contact
    Route::get('/contact' , 'contactView');

    Route::post('/contact' , 'contact');
    //end conatct
});

//routers for aythenticated users only (admins , customers , sellers)
Route::middleware(['auth'])->group(function(){
    //for admins
    Route::middleware(['admin'])->group(function(){
        
    });

    //for sellers
    Route::middleware(['seller'])->group(function () {

    });

    //for customers
    Route::middleware(['customers'])->group(function () {
        
    });
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
