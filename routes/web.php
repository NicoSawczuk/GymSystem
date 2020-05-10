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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear ');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return view('welcome');
});

// Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {

    //Gimnasios
    Route::get('/gimnasios/administrar', 'GimnasioController@index')->name('gimnasios.administrar')
    ->middleware('can:gimnasios.index');

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

    Route::get('/gimnasios/ocultar', 'GimnasioController@ocultar')->name('gimnasios.administrar')
    ->middleware('can:gimnasios.create');

    Route::get('/gimnasios/mostrar', 'GimnasioController@mostrar')->name('gimnasios.administrar')
    ->middleware('can:gimnasios.create');

    Route::get('/gimnasios/{gimnasio}/estadistica', 'GimnasioController@estadistica')->name('gimnasios.estadistica')
    ->middleware('can:gimnasios.index');

    Route::get('/gimnasios/actualizar_chart', 'GimnasioController@actualizarChart')->name('gimnasios.actualizarChart')
    ->middleware('can:gimnasios.index');

    Route::get('/gimnasios/cargar_tareas', 'GimnasioController@cargarTareas')->name('home.cargarTareas')
    ->middleware('can:gimnasios.index');


    //Home
    Route::get('/home/{gimnasio}', 'HomeController@index')->name('home')
    ->middleware('can:gimnasios.index');

    Route::get('/home/cargar_tareas', 'HomeController@cargarTareas')->name('home.cargarTareas');


    //Especialidades
    Route::get('/especialidades/{gimnasio}/administrar', 'EspecialidadController@index')->name('especialidades.administrar')
    ->middleware('can:especialidades.index');

    Route::get('/especialidades/{gimnasio}/administrar/mis_especialidades', 'EspecialidadController@indexMisEspecialidades')->name('especialidades.administrar')
    ->middleware('can:especialidades.index');

    Route::get('/especialidades/{gimnasio}/create', 'EspecialidadController@create')->name('especialidades.create')
    ->middleware('can:especialidades.create');

    Route::post('/especialidades/create', 'EspecialidadController@store')->name('especialidades.create')
    ->middleware('can:especialidades.create');

    Route::post('/especialidades/ajax_create', 'EspecialidadController@storeAjax')->name('especialidades.ajax_create')
    ->middleware('can:especialidades.create');

    Route::get('/especialidades/{gimnasio}/{especialidad}/edit/', 'EspecialidadController@edit')->name('especialidades.edit')
    ->middleware('can:especialidades.edit');

    Route::patch('/especialidades/{especialidad}', 'EspecialidadController@update')->name('especialidades.update')
    ->middleware('can:especialidades.edit');

    Route::get('/especialidades/borrar', 'EspecialidadController@destroy')->name('especialidades.destroy')
    ->middleware('can:especialidades.destroy');

    Route::get('/especialidades/{gimnasio}/estadistica', 'EspecialidadController@estadistica')->name('especialidades.estadistica')
    ->middleware('can:especialidades.index');



    

    //Clientes
    Route::get('/clientes/administrar/{gimnasio}', 'ClienteController@index')->name('clientes.administrar')
    ->middleware('can:clientes.index');

    Route::get('/clientes/administrar/en_deuda/{gimnasio}', 'ClienteController@indexEnDeuda')->name('clientes.administrarEnDeuda')
    ->middleware('can:clientes.index');

    Route::get('/clientes/administrar/en_regla/{gimnasio}', 'ClienteController@indexEnRegla')->name('clientes.administrarEnRegla')
    ->middleware('can:clientes.index');

    Route::get('/clientes/administrar/no_inscripto/{gimnasio}', 'ClienteController@indexNoInscripto')->name('clientes.administrarNoInscripto')
    ->middleware('can:clientes.index');

    Route::get('/clientes/administrar/inscripto/{gimnasio}', 'ClienteController@indexInscripto')->name('clientes.administrarInscripto')
    ->middleware('can:clientes.index');

    Route::get('/clientes/create/{gimnasio}', 'ClienteController@create')->name('clientes.create')
    ->middleware('can:clientes.create');

    Route::post('/clientes/create/{gimnasio}', 'ClienteController@store')->name('clientes.create')
    ->middleware('can:clientes.create');

    Route::get('/clientes/{cliente}/edit/{gimnasio}', 'ClienteController@edit')->name('clientes.edit')
    ->middleware('can:clientes.edit');

    Route::patch('/clientes/{cliente}', 'ClienteController@update')->name('clientes.update')
    ->middleware('can:clientes.edit');
    
    Route::get('/clientes/deuda/consultar', 'ClienteController@consultarDeuda')->name('clientes.deuda');

    Route::get('/clientes/{cliente}/perfil', 'ClienteController@perfil')->name('clientes.perfil')
    ->middleware('can:clientes.show');

    Route::get('/clientes/{cliente}/enviar_email', 'ClienteController@email')->name('clientes.email')
    ->middleware('can:clientes.show');

    Route::post('/clientes/{cliente}/enviar_email', 'ClienteController@sendEmail')->name('clientes.sendEmail')
    ->middleware('can:clientes.show');

    Route::get('/clientes/obtener_cliente/ajax/', 'ClienteController@getCliente')->name('clientes.getCliente')
    ->middleware('can:clientes.show');



    //Inscripcion
    Route::post('/inscripcion/create/{cliente}', 'InscripcionController@store')->name('inscripcion.create')->middleware('can:inscripciones.edit');



    //Cuota
    Route::post('/cuota/create/{cliente}', 'CuotaController@store')->name('cuota.create')->middleware('can:cuotas.edit');
    Route::post('/cuota/pagar_deuda/{cliente}', 'CuotaController@update')->name('cuota.update')->middleware('can:cuotas.edit');

    //EmailConfiguracion
    Route::get('/email_configuracion/{gimnasio}/edit/', 'EmailConfiguracionController@edit')->name('email_configuracion.edit')
    ->middleware('can:gimnasios.edit');

    Route::patch('/email_configuracion/{gimnasio}', 'EmailConfiguracionController@update')->name('email_configuracion.update')
    ->middleware('can:gimnasios.edit');

    //BajaCliente
    Route::post('/clientes/{cliente}/baja', 'BajaClienteController@store')->name('baja.create');
    Route::post('/clientes/{cliente}/alta', 'BajaClienteController@update')->name('baja.update');


    //Usuario
    Route::get('/usuarios/administrar/{gimnasio}', 'UserController@index')->name('usuarios.administrar')
    ->middleware('can:users.index');

    Route::get('/usuarios/{usuario}/{gimnasio}/edit', 'UserController@edit')->name('usuarios.edit')
    ->middleware('can:users.edit');

    Route::patch('/usuarios/{usuario}', 'UserController@update')->name('usuarios.update')
    ->middleware('can:users.edit');

    Route::get('/usuarios/registro_completo', function () {
        return view('usuarios/esperaPermisos');
    });

});