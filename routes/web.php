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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {

    //Gimnasios
    Route::get('/gimnasios/administrar', 'GimnasioController@index')->name('gimnasios.administrar')
    ->middleware('can:gimnasios.create');

    Route::get('/gimnasios/pais', 'GimnasioController@pais')->name('gimnasios.pais')
    ->middleware('can:gimnasios.create');

    Route::get('/gimnasios/provincia', 'GimnasioController@provincia')->name('gimnasios.provincia')
    ->middleware('can:gimnasios.create');

    Route::get('/gimnasios/create/{user}', 'GimnasioController@create')->name('gimnasios.create')
    ->middleware('can:gimnasios.create');

    Route::post('/gimnasios/{user}/create/', 'GimnasioController@store')->name('gimnasios.store')
    ->middleware('can:gimnasios.create');

    Route::get('/gimnasios/{gimnasio}/edit/', 'GimnasioController@edit')->name('gimnasios.edit')
    ->middleware('can:gimnasios.edit');

    Route::patch('/gimnasios/{gimnasio}', 'GimnasioController@update')->name('gimnasios.update')
    ->middleware('can:gimnasios.edit');



    Route::get('/home', 'HomeController@index')->name('home')
    ->middleware('can:gimnasios.index');
});