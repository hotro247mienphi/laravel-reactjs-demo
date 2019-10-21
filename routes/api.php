<?php
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Api', 'middleware' => ['allow_cross_domain']], function () {

    /*
    |--------------------------------------------------------------------------
    | CRUD api for `users` table
    | api/users/*
    |--------------------------------------------------------------------------
    */
    Route::group(['as' => 'users.', 'prefix' => '/users'], function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::post('/create', 'UserController@create')->name('create');
        Route::get('/{id}', 'UserController@show')->name('show');
        Route::put('/{id}', 'UserController@update')->name('update');
        Route::delete('/{id}', 'UserController@destroy')->name('destroy');
    });

});

/** route not found */
Route::any('{path}', function () {
    return response()->json(['success' => false, 'data' => 'Not Found'], 404);
})->middleware(['allow_cross_domain'])->where('path', '.*')->name('api_not_found');
