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

// Route::prefix('brand')->group(function() {
//     Route::get('/', 'BrandController@index');
// });

Route::group([
    'prefix' => 'admin',
    // 'middleware' => ['auth','theme:admin'],
], function () {
// brand
Route::get('brand', 'BrandController@index')->name('brand.index');
Route::get('brand/delete/{id}', 'BrandController@delete')->name('brand.delete');
Route::get('brand/add', 'BrandController@add')->name('brand.add');
Route::post('brand/add', 'BrandController@add');
Route::get('brand/edit/{id}', 'BrandController@edit')->name('brand.edit');
Route::get('brand/status/{id}', 'BrandController@status')->name('brand.status');
});
