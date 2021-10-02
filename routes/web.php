<?php

use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/move/{id}/{type}', [CategoryController::class, 'move'])->name('category.move');
Route::post('/categories/update-tree', [CategoryController::class, 'updateTree'])->name('category.updateTree');
Route::post('/categories/datatable-serverside', [CategoryController::class, 'dataTable'])->name('category.dataTable');