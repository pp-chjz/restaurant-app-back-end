<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('menu',\App\Http\Controllers\Api\MenuController::class);
Route::apiResource('ingredient',\App\Http\Controllers\Api\IngredientController::class);
Route::apiResource('order',\App\Http\Controllers\Api\OrderController::class);
Route::apiResource('table',\App\Http\Controllers\Api\TableNumberController::class);
Route::apiResource('food-table',\App\Http\Controllers\Api\FoodTableController::class);
Route::get('get-table-have-order',[\App\Http\Controllers\Api\FoodTableController::class, 'getTableHaveOrder'])
    ->middleware('api')->name('foodTable.getTableHaveOrder');
Route::get('get-total-table',[\App\Http\Controllers\Api\FoodTableController::class, 'getTotalTable'])
    ->middleware('api')->name('foodTable.getTotalTable');
Route::apiResource('image',\App\Http\Controllers\Api\ImageController::class);
Route::post('get-order-unpaid',[\App\Http\Controllers\Api\OrderController::class, 'getUnPaidOrder'])
    ->middleware('api')->name('order.getUnPaidOrder');
Route::put('/orders/{order}/update-menu-status',[\App\Http\Controllers\Api\OrderController::class, 'updateMenuStatus'])
    ->middleware('api')->name('order.updateMenuStatus');
Route::put('/orders/{order}/update-order-status',[\App\Http\Controllers\Api\OrderController::class, 'updateOrderStatus'])
    ->middleware('api')->name('order.updateOrderStatus');





Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\Api\AuthController::class, 'me']);

});
