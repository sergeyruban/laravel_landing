<?php

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

// пользовательская часть
Route::group(['middleware' => 'web'], function() {

    Route::match(['get', 'post'], '/', ['uses' => 'IndexController@execute', 'as' => 'home']);
    Route::get('/page/{alias}', ['uses' => 'PageController@execute', 'as' => 'page']);

    Route::auth();

});

// админ меню
Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function() {

    // главная страница админ меню
    // admin
    Route::get('/', function() {

        if(view()->exists('admin.index')) {
            $data = ['title' => 'Панель администратора'];

            return view('admin.index', $data);
        }

    });

    // admin/pages
    Route::group(['prefix' => 'pages'], function() {

        // admin/pages
        Route::get('/', ['uses' => 'PagesController@execute', 'as' => 'pages']);

        // admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses' => 'PagesAddController@execute', 'as' => 'pagesAdd']);

        // admin/pages/edit/5
        Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);

    });

    // admin/portfolios
    Route::group(['prefix' => 'portfolios'], function() {

        // admin/portfolios
        Route::get('/', ['uses' => 'PortfolioController@execute', 'as' => 'portfolio']);

        // admin/portfolios/add
        Route::match(['get', 'post'], '/add', ['uses' => 'PortfolioAddController@execute', 'as' => 'portfolioAdd']);

        // admin/portfolios/edit/5
        Route::match(['get', 'post', 'delete'], '/edit/{portfolio}', ['uses' => 'PortfolioEditController@execute', 'as' => 'portfolioEdit']);

    });

    // admin/services
    Route::group(['prefix' => 'services'], function() {

        // admin/services
        Route::get('/', ['uses' => 'ServiceController@execute', 'as' => 'services']);

        // admin/services/add
        Route::match(['get', 'post'], '/add', ['uses' => 'PortfolioAddController@execute', 'as' => 'servicesAdd']);

        // admin/services/edit/5
        Route::match(['get', 'post', 'delete'], '/edit/{service}', ['uses' => 'ServiceEditController@execute', 'as' => 'servicesEdit']);

    });

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
