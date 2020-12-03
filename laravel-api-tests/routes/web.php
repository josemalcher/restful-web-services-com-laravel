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
$this->resource('products', "ProductController");

$this->get('products/pg/{page}', 'ProductController@paginate')->name('products.paginate');

Route::get('/', function () {
    return view('welcome');
});
