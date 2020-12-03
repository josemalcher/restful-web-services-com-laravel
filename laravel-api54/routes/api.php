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

    $this->post('auth','Auth\AuthApiController@authenticate');
    $this->post('auth-refresh','Auth\AuthApiController@authenticate');


    $this->group(['middleware'=>'jwt.auth'], function (){
        $this->get(    'products/search',     'API\V1\ProductController@refreshToken');

        //$this->resource('products', 'API\V1\ProductController', ['except'=>['create', 'edit']]);
        $this->resource('products', 'API\V1\ProductController', ['except'=>['edit']]);
    });
});