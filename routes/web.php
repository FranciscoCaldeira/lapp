<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

    Route::get('/about', function () {
        return view('pages.about');
    });

    /->lapp.test  (foi defenido no apache e no system32>etc)
*/

                //controller@metodo
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

//criar automaticamente as rotas de index create store edit update show destroy
Route::resource('posts','PostsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
