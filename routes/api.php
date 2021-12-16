<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['api'],'namespace'=>'Api'],function ($router) {

    Route::apiResource('products','ProductController');
    Route::get('findProduct','ProductController@search');
    Route::get('get_categories','ProductController@allCategories');

});


