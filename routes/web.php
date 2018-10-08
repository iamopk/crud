<?php

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
})->name('front');

Auth::routes(['verify' => true]);

Route::get('/profile', 'ProfileController@index')->name('profile');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth'],
], function () {
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/users/create', 'UserController@create')->name('user.create');
    Route::post('/users', 'UserController@store')->name('user.store');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('user.delete');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/users/edit/{id}', 'UserController@update')->name('user.update');
});