<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public APIs
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user', [UserController::class, 'store'])->name('user.store');


// Private APIs
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    // Admin APIs
    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',         'index');
        Route::get('/carousel/all',     'all');
        Route::get('/carousel/{id}',    'show');
        Route::post('/carousel',        'store');
        Route::put('/carousel/{id}',    'update');
        Route::delete('/carousel/{id}', 'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                 'index');
        Route::delete('/user/{id}',         'destroy');
        Route::get('/user/{id}',            'show');
        // Route::post('/user',                'store')->name('user.store');
        Route::put('/user/{id}',            'update')->name('user.update');
        Route::put('/user/email/{id}',      'email')->name('user.email');
        Route::put('/user/image/{id}',      'image')->name('user.image');
        Route::put('/user/password/{id}',   'password')->name('user.password');
    });

    // User Specific APIs
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/image', [ProfileController::class, 'image'])->name('profile.image');
});
