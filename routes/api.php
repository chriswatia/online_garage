<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\SendSmsController;
use App\Http\Controllers\TransactionController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sendNotification', [App\Http\Controllers\SendSmsController::class, 'sendNotification']);


Route::get('/getCustomerVehicles/{id}', [App\Http\Controllers\UserController::class, 'getCustomerVehicles']);
Route::get('/getVehicle/{id}', [App\Http\Controllers\UserController::class, 'getVehicle']);
Route::post('/sms', [SendSmsController::class, 'send']);
Route::post('/saveCountry', [SendSmsController::class, 'saveCountry']);

Route::get('/sendmail', function (Request $request) {
    $ip = $request->ip();
    Mail::raw('Hi user, a new login into your account from the IP Address: ', function ($message) {
        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $message->to('chriswatia@gmail.com', 'chriswatia1@gmail.com');
    });
});

Route::get('/stkpush', [MpesaController::class, 'stkpush']);
Route::get('/query', [MpesaController::class, 'query']);
Route::get('/generateAuthCode', [MpesaController::class, 'generateAuthCode']);
