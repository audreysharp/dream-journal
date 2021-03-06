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
    if (Input::has('deleted')) { // if ?deleted=true in URL
        $data['justDeleted'] = 'true';
    } else {
        $data['justDeleted'] = 'false';
    }
    return view('index', $data);
});

// Add or update entry
Route::get('/add', function () {
    if (Input::has('update')) { // if ?update={id} in URL
        $data['id'] = (string) Input::get('update');
    } else {
        $data['id'] = '-1';
    }
    return view('new', $data);
});

// View single entry
Route::get('/view/{id}', function ($id) {
    $data = [];
    $data['id'] = $id;
    if (Input::has('created')) { // if ?created=true in URL
        $data['justCreated'] = 'true';
    } else {
        $data['justCreated'] = 'false';
    }
    if (Input::has('updated')) { // if ?updated=true in URL
        $data['justUpdated'] = 'true';
    } else {
        $data['justUpdated'] = 'false';
    }
    return view('view', $data);
});

// View styleguide
Route::get('/styleguide', function () {
    return view('style');
});

// View credits
Route::get('/credits', function () {
    return view('credits');
});

// View instructions
Route::get('/help', function () {
    return view('help');
});