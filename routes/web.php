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

@include('admin.php');

