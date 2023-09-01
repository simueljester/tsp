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
        Route::post('/delete', ['as' => 'delete', 'uses' => 'InquiryController@delete']);
    });

    //My Website
    Route::group(['prefix'=>'my-website','as'=>'my-website.'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'MyWebsiteController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'MyWebsiteController@create']);
        Route::post('/save', ['as' => 'save', 'uses' => 'MyWebsiteController@save']);
        Route::post('/delete', ['as' => 'delete', 'uses' => 'MyWebsiteController@delete']);
        Route::post('/mark-complete', ['as' => 'mark-complete', 'uses' => 'MyWebsiteController@markComplete']);
        Route::post('/mark-inprogress', ['as' => 'mark-inprogress', 'uses' => 'MyWebsiteController@markInprogress']);
        Route::post('/activate', ['as' => 'activate', 'uses' => 'MyWebsiteController@activate']);
        Route::post('/deactivate', ['as' => 'deactivate', 'uses' => 'MyWebsiteController@deactivate']);

        Route::group(['prefix'=>'manage-content','as'=>'manage-content.'], function(){
            Route::get('/introduction/{my_website}', ['as' => 'introduction', 'uses' => 'MyWebsiteContentController@showIntro']);
            Route::get('/services/{my_website}', ['as' => 'services', 'uses' => 'MyWebsiteContentController@showServices']);
            Route::get('/articles/{my_website}', ['as' => 'articles', 'uses' => 'MyWebsiteContentController@showArticles']);
            Route::get('/about/{my_website}', ['as' => 'about', 'uses' => 'MyWebsiteContentController@showAbout']);
            Route::get('/news/{my_website}', ['as' => 'news', 'uses' => 'MyWebsiteContentController@showNews']);
            Route::get('/choose_us/{my_website}', ['as' => 'choose_us', 'uses' => 'MyWebsiteContentController@showChooseUs']);
            Route::get('/finish/{my_website}', ['as' => 'finish', 'uses' => 'MyWebsiteContentController@finish']);
            Route::post('/save', ['as' => 'save', 'uses' => 'MyWebsiteContentController@save']);
        });

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
            Route::post('/set-active', ['as' => 'set-active', 'uses' => 'IntroductionController@setActive']);
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

        // About
        Route::group(['prefix'=>'about','as'=>'about.'], function(){
            Route::get('/list/{viewingId?}', ['as' => 'index', 'uses' => 'AboutController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'AboutController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'AboutController@save']);
            Route::get('/show/{about}', ['as' => 'show', 'uses' => 'AboutController@show']);
            Route::get('/edit/{about}', ['as' => 'edit', 'uses' => 'AboutController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'AboutController@update']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'AboutController@delete']);
        });

        // News
        Route::group(['prefix'=>'news','as'=>'news.'], function(){
            Route::get('/list', ['as' => 'index', 'uses' => 'NewsController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'NewsController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'NewsController@save']);
            Route::get('/show/{news}', ['as' => 'show', 'uses' => 'NewsController@show']);
            Route::get('/edit/{news}', ['as' => 'edit', 'uses' => 'NewsController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'NewsController@update']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'NewsController@delete']);
            Route::post('/remove-image', ['as' => 'remove-image', 'uses' => 'NewsController@removeImage']);
        });

        // Choose Us
        Route::group(['prefix'=>'choose-us','as'=>'choose-us.'], function(){
            Route::get('/list', ['as' => 'index', 'uses' => 'ChooseUsController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'ChooseUsController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'ChooseUsController@save']);
            Route::get('/show/{choose_us}', ['as' => 'show', 'uses' => 'ChooseUsController@show']);
            Route::get('/edit/{choose_us}', ['as' => 'edit', 'uses' => 'ChooseUsController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'ChooseUsController@update']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'ChooseUsController@delete']);
        });

        // Reviews
        Route::group(['prefix'=>'reviews','as'=>'reviews.'], function(){
            Route::get('/list', ['as' => 'index', 'uses' => 'ReviewController@index']);
            Route::get('/create', ['as' => 'create', 'uses' => 'ReviewController@create']);
            Route::post('/save', ['as' => 'save', 'uses' => 'ReviewController@save']);
            Route::get('/edit/{review}', ['as' => 'edit', 'uses' => 'ReviewController@edit']);
            Route::post('/update', ['as' => 'update', 'uses' => 'ReviewController@update']);
            Route::post('/delete', ['as' => 'delete', 'uses' => 'ReviewController@delete']);
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


