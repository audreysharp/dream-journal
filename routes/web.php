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

// import Input to get url parameters
use Illuminate\Support\Facades\Input;

// Entries collection routes
Route::get('/entries', 'EntryController@index');
Route::post('/entries', 'EntryController@create');

// Entries singular routes
Route::get('/entries/{id}', 'EntryController@show');
Route::put('/entries/{id}', 'EntryController@update');
Route::delete('/entries/{id}', 'EntryController@destroy');

// HTML/view responses
Route::get('/', function () {
    $data = [];
    if (Input::has('deleted')) {
        $data['justDeleted'] = 'true';
    } else {
        $data['justDeleted'] = 'false';
    }
    return view('index', $data);
});

Route::get('/add', function () {
    if (Input::has('update')) {
        $data['id'] = (string) Input::get('update');
    } else {
        $data['id'] = '-1';
    }
    return view('new', $data);
});

Route::get('/view/{id}', function ($id) {
    $data = [];
    $data['id'] = $id;
    if (Input::has('created')) {
        $data['justCreated'] = 'true';
    } else {
        $data['justCreated'] = 'false';
    }
    if (Input::has('updated')) {
        $data['justUpdated'] = 'true';
    } else {
        $data['justUpdated'] = 'false';
    }
    return view('view', $data);
});

Route::get('/styleguide', function () {
    return view('style');
});

Route::get('/credits', function () {
    return view('credits');
});