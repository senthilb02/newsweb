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

Route::get('/', function () {
    return view('welcome');
});
Route::match(array('GET','POST'),'search','newsController@newsSearch');
Route::match(array('GET','POST'),'websitesearch','newsController@websitesearch');
Route::get('/type','newsController@newstopic');