<?php

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
    return view('auth.login ');
});

Auth::routes();

//Route::get('{/vue_capture?}',function(){ return view('welcome'); })->where('vue_capture','[\/\w\.-]*');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::middleware(['auth'])->group(function() {
Route::get('{path}',function(){ return view('welcome'); })->where('path','([A-z\d\-\/_.]+)');

          });
    });

