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



    //Home
    Route::get('/home/{gimnasio}', 'HomeController@index')->name('home')
    ->middleware('can:gimnasios.index');


    //Especialidades
    Route::get('/especialidades/{gimnasio}/administrar', 'EspecialidadController@index')->name('especialidades.administrar')
    ->middleware('can:especialidades.index');

    Route::get('/especialidades/{gimnasio}/create', 'EspecialidadController@create')->name('especialidades.create')
    ->middleware('can:especialidades.create');

    Route::post('/especialidades/create', 'EspecialidadController@store')->name('especialidades.create')
    ->middleware('can:especialidades.create');

    Route::get('/especialidades/{gimnasio}/{especialidad}/edit/', 'EspecialidadController@edit')->name('especialidades.edit')
    ->middleware('can:especialidades.edit');

    Route::patch('/especialidades/{especialidad}', 'EspecialidadController@update')->name('especialidades.update')
    ->middleware('can:especialidades.edit');

    //Clientes
    Route::get('/clientes/administrar/{gimnasio}', 'ClienteController@index')->name('clientes.administrar')
    ->middleware('can:clientes.index');

    Route::get('/clientes/create/{gimnasio}', 'ClienteController@create')->name('clientes.create')
    ->middleware('can:clientes.create');

    Route::post('/clientes/create/{gimnasio}', 'ClienteController@store')->name('clientes.create')
    ->middleware('can:clientes.create');

    Route::get('/clientes/{cliente}/edit/{gimasio}', 'ClienteController@edit')->name('clientes.edit')
    ->middleware('can:clientes.edit');

    Route::patch('/clientes/{cliente}', 'ClienteController@update')->name('clientes.update')
    ->middleware('can:clientes.edit');
    
    Route::get('/clientes/deuda/consultar', 'ClienteController@consultarDeuda')->name('clientes.deuda');



    //Inscripcion
    Route::post('/inscripcion/create/{cliente}', 'InscripcionController@store')->name('inscripcion.create')->middleware('can:inscripciones.edit');



    //Cuota
    Route::post('/cuota/create/{cliente}', 'CuotaController@store')->name('cuota.create')->middleware('can:cuotas.edit');
    Route::post('/cuota/pagar_deuda/{cliente}', 'CuotaController@update')->name('cuota.update')->middleware('can:cuotas.edit');
     

});