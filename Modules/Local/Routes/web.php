<?php
use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => 'admin',
    // 'middleware' => ['auth','theme:admin'],
], function () {
// local
Route::get('province', 'ProvinceController@index')->name('province.index');
Route::get('province/edit/{id}', 'ProvinceController@edit');
Route::post('province/postEdit', 'ProvinceController@postEdit')->name('province.postEdit');
Route::get('province/delete/{id}', 'ProvinceController@delete');

Route::get('district', 'DistrictController@index')->name('district.index');
Route::get('district/edit/{id}', 'DistrictController@edit');
Route::post('district/postEdit', 'DistrictController@postEdit')->name('district.postEdit');
Route::get('district/delete/{id}', 'DistrictController@delete');
Route::get('district/list/{province_id}', 'DistrictController@listByProvince');
Route::get('district/province/list', 'DistrictController@allProvince');

Route::get('ward', 'WardController@index')->name('ward.index');
Route::get('ward/edit/{id}', 'WardController@edit');
Route::post('ward/postEdit', 'WardController@postEdit')->name('ward.postEdit');
Route::get('ward/delete/{id}', 'WardController@delete');


});
