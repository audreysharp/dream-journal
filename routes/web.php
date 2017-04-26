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

// Entries collection routes
Route::get('/entries', 'EntryController@index');
Route::post('/entries', 'EntryController@create');

// Entries singular routes
Route::get('/entries/{id}', 'EntryController@show');
Route::put('/entries/{id}', 'EntryController@update');
Route::delete('/entries/{id}', 'EntryController@destroy');

// HTML/view responses
Route::get('/', function () {
    return view('index');
});

Route::get('/add', function () {
    return view('new');
});

Route::get('/style', function () {
    return view('style');
});

Route::get('/credits', function () {
    return view('credits');
});