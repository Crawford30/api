<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/products', 'ProductController');


//REview is got from the product id, like products/11/review

Route::group(['prefix' => 'products'], function(){

	Route::apiResource('/{product}/reviews', 'ReviewController');
});