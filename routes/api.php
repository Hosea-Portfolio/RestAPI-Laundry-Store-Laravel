<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaundryTypeController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentStatusController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'laundry-type'], function () {
    Route::get('/', [LaundryTypeController::class, 'index']);
    Route::get('/{id}', [LaundryTypeController::class, 'show']);
    Route::post('/', [LaundryTypeController::class, 'store']);
    Route::patch('/{id}', [LaundryTypeController::class, 'update']);
    Route::delete('/{id}', [LaundryTypeController::class, 'delete']);
});
Route::group(['prefix' => 'transaction'], function () {
    Route::get('/', [TransactionController::class, 'index']);
    Route::get('/{id}', [TransactionController::class, 'show']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::patch('/{id}', [TransactionController::class, 'update']);
    Route::delete('/{id}', [TransactionController::class, 'delete']);
});

Route::group(['prefix' => 'payment-type'], function () {
    Route::get('/', [PaymentTypeController::class, 'index']);
    Route::get('/{id}', [PaymentTypeController::class, 'show']);
    Route::post('/', [PaymentTypeController::class, 'store']);
    Route::patch('/{id}', [PaymentTypeController::class, 'update']);
    Route::delete('/{id}', [PaymentTypeController::class, 'delete']);
});

Route::group(['prefix' => 'payment-status'], function () {
    Route::get('/', [PaymentStatusController::class, 'index']);
    Route::get('/{id}', [PaymentStatusController::class, 'show']);
    Route::post('/', [PaymentStatusController::class, 'store']);
    Route::patch('/{id}', [PaymentStatusController::class, 'update']);
    Route::delete('/{id}', [PaymentStatusController::class, 'delete']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::patch('/{id}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
});
