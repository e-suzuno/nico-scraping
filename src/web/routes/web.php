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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'IndexController@index')->name("index");
Route::get('/about', 'IndexController@about')->name("about");



Route::post('/search-api', 'NicoComicController@search')->name("search-api");
Route::post('/add-tag-api', 'NicoComicController@addTag')->name("add-tag-api");
Route::post('/add-tag-recommended-api', 'NicoComicController@addTagAdminRecommended')->name("add-tag-recommended-api");


