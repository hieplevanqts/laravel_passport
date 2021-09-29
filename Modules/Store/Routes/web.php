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

Route::group([
    'prefix' => 'admin',
    // 'middleware' => ['auth','theme:admin'],
], function () {
// store
Route::get('store', 'StoreController@index')->name('store.index');
Route::get('store/add', 'StoreController@create')->name('store.add');
Route::post('store/add', 'StoreController@create')->name('store.postAdd');
Route::get('store/delete/{id}', 'StoreController@destroy')->name('store.delete');
Route::get('store/detail/{id}', 'StoreController@show')->name('store.detail');
Route::get('store/edit/{id}', 'StoreController@edit')->name('store.edit');
Route::post('store/edit/{id}', 'StoreController@edit')->name('store.postEdit');
Route::get('store/status/{id}', 'StoreController@status')->name('store.status');
});
