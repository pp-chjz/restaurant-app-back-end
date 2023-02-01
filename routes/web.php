<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "hello";
});

Route::get('/hello/array', function () {
    return [
        'message' => 'Hello' ,
        'succues' => true 
    ];
});

Route::get('/posts/{id}', function ($id) {
    return "Post ID" .$id;
});

Route::get('/about', function () {
    return view('about',[
        'name' => 'Your name',
        'info' =>[
            'addr' => 'bangkok',
            'mail' => '@hotmail.com'
        ]
    ]);
});

Route::resource('menu',\App\Http\Controllers\MenuController::class);
