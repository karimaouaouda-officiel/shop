<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\GuestController;
use Illuminate\Http\Request;

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
    Route::get('/contact' , 'contactView')->name('contactView');

    Route::post('/contact' , 'contact')->name('contact');
    //end conatct

    Route::get('/discover' , 'discover');
});

//routers for aythenticated users only (admins , customers , sellers)
Route::middleware(['auth'])->group(function(){
    //for admins
    Route::middleware(['admin'])->prefix('dashboard')->group(function(){
        Route::controller(ShopController::class)->group(function(){
            Route::get('/shops' , 'getAll');
        });
    });

    //for sellers
    Route::middleware(['auth','seller'])->group(function () {
        Route::controller(ProductController::class)->group(function(){
            Route::get('/shop/create/product' , 'createProductView')->middleware('myshop');
            Route::post('/shop/postproduct' , 'store')->name('postProduct');
            //Route::post('/addProduct' , 'store');
        });

        Route::controller(ShopController::class)->group(function(){
            Route::get('/create/shop' , 'createView');
            Route::post('/create/shop' , 'store')->name('createShop');
        });
    });
    //for customers
    Route::middleware(['customers'])->group(function () {
        
    });
});


/**
 * this part will be a container to routes that is necessery for application
 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');