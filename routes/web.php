<?php

use App\Http\Middleware\MyMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

Route::group([
    'middleware' => MyMiddleware::class,
    'as'=> 'group_01.'
], function () {

    Route::get('/', function () {
        return View::make('welcome');
    })->name('index');

    Route::get('/users', function () {
        return view('welcome');
    })->name('user_list');

    Route::get('/users/{id}', function () {
        return view('welcome');
    })->name('user_detail');

});
