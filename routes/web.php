<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {return view('page.home.index'); });
Route::get('/nosotros', function () {return view('page.nosotros.index'); });
Route::get('/servicios', function () {return view('page.servicios.index'); });
Route::get('/contactos', function () {return view('page.contactos.index'); });
Route::get('/noticias', function () {return view('page.noticias.index'); });
// Route::get('/', 'HomeController@index');

// Subir Oferta
Route::get('/oferta-at/{id}', function($id){
    $atconsultor = App\AtConsultor::find($id);
    $consultor = App\Consultor::find($atconsultor->consultor_id);
    return view('subiroferta', compact('consultor', 'atconsultor'));
});

Route::post('/oferta-at/{id}', 'ApiController@oferta');

require base_path('routes/empresas.php');
require base_path('routes/empresaempresarios.php');
require base_path('routes/empresarios.php');
require base_path('routes/consultores.php');
require base_path('routes/asistencias.php');
require base_path('routes/capacitaciones.php');
require base_path('routes/eventos.php');
require base_path('routes/salidas.php');
require base_path('routes/especialidades.php');
require base_path('routes/pdf.php');

Route::get('/dash/{tiempo}', 'DashController@index');
Route::get('/usuarios/auth', 'UsuarioController@auth');
// Route::get('/capacitaciones', 'CapacitacionesController@index');
// Route::get('/eventos', 'EventosController@index');

Auth::routes();

