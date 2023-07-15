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

//Page Routes - Landing
//Landing page means the website

Route::get('/', ['as' => 'index', 'uses' => 'PageLandingController@index']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




//Page Routes - Admin
Route::group(['prefix'=>'dashboard','as'=>'dashboard.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
});


//Inquiry Routes
Route::group(['prefix'=>'inquiry','as'=>'inquiry.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'InquiryController@index']);
});

//User Routes
Route::group(['prefix'=>'users','as'=>'users.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
    Route::get('/create', ['as' => 'create', 'uses' => 'UserController@create']);
    Route::post('/save', ['as' => 'save', 'uses' => 'UserController@save']);
    Route::get('/show/{user}', ['as' => 'show', 'uses' => 'UserController@show']);
    Route::get('/edit/{user}', ['as' => 'edit', 'uses' => 'UserController@edit']);
    Route::post('/update', ['as' => 'update', 'uses' => 'UserController@update']);
    Route::get('/archive/{user}', ['as' => 'archive', 'uses' => 'UserController@archive']);
    Route::get('/set-to-active/{user}', ['as' => 'set.active', 'uses' => 'UserController@setToActive']);
});
