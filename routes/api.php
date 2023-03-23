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
Route::post('get-order-unpaid-can-cancel',[\App\Http\Controllers\Api\OrderController::class, 'getUnPaidOrderThatCanCancel'])
    ->middleware('api')->name('order.getUnPaidOrderThatCanCancel');
Route::put('/orders/{order}/update-menu-status',[\App\Http\Controllers\Api\OrderController::class, 'updateMenuStatus'])
    ->middleware('api')->name('order.updateMenuStatus');
Route::get('/orders/wait-for-check-bill',[\App\Http\Controllers\Api\OrderController::class, 'getOrderWaitForCheckBill'])
    ->middleware('api')->name('order.getOrderWaitForCheckBill');
Route::put('/orders/{order}/update-order-status',[\App\Http\Controllers\Api\OrderController::class, 'updateOrderStatus'])
    ->middleware('api')->name('order.updateOrderStatus');
Route::post('/orders/get-order-by-search',[\App\Http\Controllers\Api\OrderController::class, 'getOrderBySearch'])
    ->middleware('api')->name('order.getOrderBySearch');
Route::post('/orders/update-order-status-pay',[\App\Http\Controllers\Api\OrderController::class, 'updateOrderStatusPay'])
    ->middleware('api')->name('order.updateOrderStatusPay');
Route::get('/orders/get-order-by-date',[\App\Http\Controllers\Api\OrderController::class, 'getOrderByDate'])
    ->middleware('api')->name('order.getOrderByDate');
Route::post('/menus/get-menu-by-search',[\App\Http\Controllers\Api\MenuController::class, 'getMenuBySearch'])
    ->middleware('api')->name('menu.getMenuBySearch');
Route::post('/ingredients/{ingredient}/update-ingredient-status',[\App\Http\Controllers\Api\IngredientController::class, 'updateStatus'])
    ->middleware('api')->name('ingredient.updateStatus');
Route::post('/ingredients/get-ingredient-by-search',[\App\Http\Controllers\Api\IngredientController::class, 'getIngredientBySearch'])
    ->middleware('api')->name('ingredient.getIngredientBySearch');
Route::post('/menus/get-menu-by-customer-search',[\App\Http\Controllers\Api\MenuController::class, 'getMenuByCustomerSearch'])
    ->middleware('api')->name('menu.getMenuByCustomerSearch');


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
