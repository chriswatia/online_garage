<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){    
    Route::get('/', [App\Http\Controllers\UserDashboardController::class, 'index']);

    //Update profile
    Route::get('profile/{id}', [App\Http\Controllers\UserController::class, 'editProfile']);
    Route::put('profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile']);

    Route::post('/sms', [App\Http\Controllers\SendSmsController::class, 'send']);

});


Route::prefix('admin')->middleware(['auth', 'IsAdmin', 'verified'])->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //USER LIST
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::put('edit-user/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('delete-user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
    
    //ROLES
    Route::get('roles', [App\Http\Controllers\RoleController::class, 'index']);

    //CATEGORIES ROUTES
    Route::get('categories', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::put('edit-category/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
});
