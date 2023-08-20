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



Route::group(['middleware' => ['auth'],'prefix'=>'admin','as'=>'admin.'], function () {

    //Dashboard
    Route::group(['prefix'=>'dashboard','as'=>'dashboard.'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
    });


    //Inquiry
    Route::group(['prefix'=>'inquiry','as'=>'inquiry.'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'InquiryController@index']);
    });


    //Page Management
    Route::group(['prefix'=>'pages','as'=>'pages.'], function(){

        // Intro
        Route::group(['prefix'=>'introduction','as'=>'introduction.'], function(){
            Route::get('/list/{viewingId?}', ['as' => 'index', 'uses' => 'IntroductionController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'IntroductionController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'IntroductionController@save']);
            Route::get('/edit/{introduction}', ['as' => 'edit', 'uses' => 'IntroductionController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'IntroductionController@update']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'IntroductionController@delete']);
        });

        // Services
        Route::group(['prefix'=>'services','as'=>'services.'], function(){
            Route::group(['prefix'=>'categories','as'=>'categories.'], function(){
                Route::get('/list', ['as' => 'index', 'uses' => 'ServiceCategoryController@index']);
                Route::get('/create', ['as' => 'create', 'uses' => 'ServiceCategoryController@create']);
                Route::post('/save', ['as' => 'save', 'uses' => 'ServiceCategoryController@save']);
                Route::get('/edit/{category}', ['as' => 'edit', 'uses' => 'ServiceCategoryController@edit']);
                Route::post('/update', ['as' => 'update', 'uses' => 'ServiceCategoryController@update']);
                Route::post('/delete', ['as' => 'delete', 'uses' => 'ServiceCategoryController@delete']);
                Route::post('/reassign-service', ['as' => 'reassign-service', 'uses' => 'ServiceCategoryController@reassignService']);
            });

            Route::get('/list/{category}', ['as' => 'index', 'uses' => 'ServiceController@index']);
            Route::get('/uncategorized', ['as' => 'index-uncategorized', 'uses' => 'ServiceController@indexUncategorize']);
            Route::get('/create/{category}', ['as' => 'create', 'uses' => 'ServiceController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'ServiceController@save']);
            Route::get('/show/{service}', ['as' => 'show', 'uses' => 'ServiceController@show']);
            Route::get('/edit/{service}', ['as' => 'edit', 'uses' => 'ServiceController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'ServiceController@update']);
            Route::post('/remove-image', ['as' => 'remove-image', 'uses' => 'ServiceController@removeImage']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'ServiceController@delete']);
        });

        // Articles
        Route::group(['prefix'=>'articles','as'=>'articles.'], function(){
            Route::get('/list', ['as' => 'index', 'uses' => 'ArticleController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'ArticleController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'ArticleController@save']);
            Route::get('/show/{article}', ['as' => 'show', 'uses' => 'ArticleController@show']);
            Route::get('/edit/{article}', ['as' => 'edit', 'uses' => 'ArticleController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'ArticleController@update']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'ArticleController@delete']);
        });

    });

    //Users
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


    //Helper Routes
    Route::group(['prefix'=>'dropzone','as'=>'dropzone.'], function(){
        Route::post('/store', ['as' => 'store', 'uses' => 'DropzoneController@store']);
    });


});


