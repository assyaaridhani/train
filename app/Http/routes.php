<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('articles','ArticlesController');
Route::resource('gallery','ArticlesController');
Route::resource('/users', 'UsersController', array('except' => array('index', 'destroy')));
Route::resource('/comments','CommentsController');
Route::get('/export', 'ExcelController@export');
Route::get('/getImport', 'ExcelController@getImport');
Route::post('/postImport', 'ExcelController@postImport');
