<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Http\Controllers\EventsController;

use App\Http\Controllers\UserController;

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




Route::get('/events', [IndexController::class,'events']);


Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes/api.php
Route::get('/events', [EventsController::class, 'getEvents']);
Route::post('/events/{eventId}/ratings', [EventsController::class, 'addRating']);

// routes/api.php
Route::post('/store-rating', [EventsController::class, 'storeRatings']);
// routes/api.php or routes/web.php

Route::get('/view-ratings', [EventsController::class, 'viewRatings']);

