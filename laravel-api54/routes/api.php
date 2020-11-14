<?php

//use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


$this->group(['prefix'=> 'V1'], function (){

    $this->group(['middleware'=>'jwt.auth'], function (){
        $this->post(    'products/search',     'API\V1\ProductController@search');

        $this->resource('products', 'API\V1\ProductController', ['except'=>['create', 'edit']]);
    });
});