<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EventsController;
use App\Http\Middleware\AdminAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/clear', function () {
    $exitCode = Artisan::call('optimize');
    return "cache cleared";
});


Route::get('/', [IndexController::class, 'index'])->name('index');


Auth::routes(); 
// Admin Routes
Route::get('/admin', function () { return view('admin/admin_login'); });
Route::get('/login', [AdminController::class, 'getLogin'])->name('adminLogin');
Route::post('/login', [AdminController::class, 'postLogin'])->name('adminLoginPost');
Route::match(['get','post'], '/forgot-password/', [AdminController::class, 'forgotPassword']);
Route::match(['get','post'], '/reset-password/', [AdminController::class, 'resetPassword']);
Route::match(['get','post'],'/changePassword', [AdminController::class, 'changePassword']);
Auth::routes();
Route::middleware([AdminAuthenticated::class])->group(function () {
    //Dashboard
    Route::match(['get','post'], '/admin/dashboard', [AdminController::class, 'viewDashboard']);
    //Admin-Setting
    Route::match(['get','post'], 'admin/admin-setting/', [AdminController::class, 'setting']);
    Route::get('/logout', [AdminController::class, 'logout']);
    Route::match(['get','post'], '/admin/add-admin/', [AdminController::class, 'addAdmin']);
    Route::get('/admin/view-admin', [AdminController::class, 'viewAdmin']);
    Route::match(['get','post'], '/change-admin-status-zero/{id}', [AdminController::class, 'chnageAdminStatusZero']);
    Route::match(['get','post'], '/change-admin-status-one/{id}', [AdminController::class, 'chnageAdminStatusOne']);
    Route::match(['get','post'], '/admin/delete-admin/{id}', [AdminController::class, 'deleteAdmin']);

    
    // Events
    Route::match(['get','post'], 'admin/edit-events/{id}', [EventsController::class, 'editEvents']);
    Route::match(['get','post'], 'admin/view-events/', [EventsController::class, 'viewEvents']);
    Route::match(['get','post'], 'admin/add-events/', [EventsController::class, 'addEvents']);
    Route::match(['get','post'], 'admin/delete-events/{id}', [EventsController::class,'deleteEvents']);

     // Ratings Events
     Route::match(['get','post'], 'admin/add-ratings/', [EventsController::class, 'addRatings']);
     Route::match(['get','post'], 'admin/edit-ratings/{id}', [EventsController::class, 'editRatings']);
     Route::match(['get','post'], 'admin/view-ratings/', [EventsController::class, 'viewRatings']);
     Route::match(['get','post'], 'admin/delete-ratings/{id}', [EventsController::class,'deleteRatings']);


});




//OTHER ROUTES
Route::match(['get','post'], '/admin-login-check', [AdminController::class, 'login']);
Route::post('/admin-reset-password', [AdminController::class, 'resetPassword']);

Route::get('/admin-forgot-password', function () {
    return view('admin/admin-forgot-password');
});

Route::get('/admin-login', function () {
    return view('admin/admin_login');
});
