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
    Route::get('/home', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\UserDashboardController::class, 'index']);

    //Update profile
    Route::get('profile/{id}', [App\Http\Controllers\UserController::class, 'editProfile']);
    Route::put('profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile']);
    Route::get('getCustomerVehicles/{id}', [App\Http\Controllers\UserController::class, 'getCustomerVehicles']);

    //VEHICLE ROUTES
    Route::get('vehicles', [App\Http\Controllers\VehicleController::class, 'index']);
    Route::get('add-vehicle', [App\Http\Controllers\VehicleController::class, 'create']);
    Route::post('add-vehicle', [App\Http\Controllers\VehicleController::class, 'store']);
    Route::get('edit-vehicle/{id}', [App\Http\Controllers\VehicleController::class, 'edit']);
    Route::put('edit-vehicle/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
    Route::get('delete-vehicle/{id}', [App\Http\Controllers\VehicleController::class, 'destroy']);

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

    //BRANDS ROUTES
    Route::get('brands', [App\Http\Controllers\BrandController::class, 'index']);
    Route::get('add-brand', [App\Http\Controllers\BrandController::class, 'create']);
    Route::post('add-brand', [App\Http\Controllers\BrandController::class, 'store']);
    Route::get('edit-brand/{id}', [App\Http\Controllers\BrandController::class, 'edit']);
    Route::put('edit-brand/{id}', [App\Http\Controllers\BrandController::class, 'update']);
    Route::get('delete-brand/{id}', [App\Http\Controllers\BrandController::class, 'destroy']);

    //PRODUCTS ROUTES
    Route::get('products', [App\Http\Controllers\ProductController::class, 'index']);
    Route::get('add-product', [App\Http\Controllers\ProductController::class, 'create']);
    Route::post('add-product', [App\Http\Controllers\ProductController::class, 'store']);
    Route::get('edit-product/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
    Route::put('edit-product/{id}', [App\Http\Controllers\ProductController::class, 'update']);
    Route::get('delete-product/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);

    //MECHANICS ROUTES
    Route::get('mechanics', [App\Http\Controllers\MechanicController::class, 'index']);
    Route::get('add-mechanic', [App\Http\Controllers\MechanicController::class, 'create']);
    Route::post('add-mechanic', [App\Http\Controllers\MechanicController::class, 'store']);
    Route::get('edit-mechanic/{id}', [App\Http\Controllers\MechanicController::class, 'edit']);
    Route::put('edit-mechanic/{id}', [App\Http\Controllers\MechanicController::class, 'update']);
    Route::get('delete-mechanic/{id}', [App\Http\Controllers\MechanicController::class, 'destroy']);

    //SERVICES ROUTES
    Route::get('services', [App\Http\Controllers\ServiceController::class, 'index']);
    Route::get('add-service', [App\Http\Controllers\ServiceController::class, 'create']);
    Route::post('add-service', [App\Http\Controllers\ServiceController::class, 'store']);
    Route::get('edit-service/{id}', [App\Http\Controllers\ServiceController::class, 'edit']);
    Route::put('edit-service/{id}', [App\Http\Controllers\ServiceController::class, 'update']);
    Route::get('delete-service/{id}', [App\Http\Controllers\ServiceController::class, 'destroy']);

    //ORDERS ROUTES
    Route::get('orders', [App\Http\Controllers\OrderController::class, 'index']);
    Route::get('add-order', [App\Http\Controllers\OrderController::class, 'create']);
    Route::post('add-order', [App\Http\Controllers\OrderController::class, 'store']);
    Route::get('edit-order/{id}', [App\Http\Controllers\OrderController::class, 'edit']);
    Route::put('edit-order/{id}', [App\Http\Controllers\OrderController::class, 'update']);
    Route::get('delete-order/{id}', [App\Http\Controllers\OrderController::class, 'destroy']);
});
