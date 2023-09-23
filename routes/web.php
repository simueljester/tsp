<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

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
Route::post('/save-inquiry', ['as' => 'save-inquiry', 'uses' => 'PageLandingController@saveInquiry']);
Route::post('/save-review', ['as' => 'save-review', 'uses' => 'PageLandingController@saveReview']);
Route::get('/service-list', ['as' => 'list-catalog', 'uses' => 'PageLandingController@showCatalog']);
Route::get('/service-list/{service}', ['as' => 'page-landing-show-service', 'uses' => 'PageLandingController@showService']);
Route::get('/article-list', ['as' => 'list-article', 'uses' => 'PageLandingController@showArticleList']);
Route::get('/article-list/{article}', ['as' => 'page-landing-show-article', 'uses' => 'PageLandingController@showArticle']);

Route::get('/set-cookie', function () {
    $uuid = (string) Str::uuid();

    Cookie::queue(Cookie::make('uuid', $uuid, 2));
 });

 Route::get('/view-cookie', function () {
    dd(request()->cookie('uuid'));
 });

@include('admin.php');

