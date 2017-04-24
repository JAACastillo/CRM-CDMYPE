<?php


Route::get('/admin', 'DashController@admin');

Route::group(['prefix' => 'api'], function () {

    Route::get('/dash/{tiempo}', 'DashController@index');
    
    require base_path('routes/dash/clientes/empresas.php');
    require base_path('routes/dash/clientes/empresaempresarios.php');
    require base_path('routes/dash/clientes/empresarios.php');

    require base_path('routes/dash/consultores.php');

    require base_path('routes/dash/at/tdr.php');
    require base_path('routes/dash/at/consultores.php');
    require base_path('routes/dash/at/contratos.php');
    require base_path('routes/dash/at/ampliaciones.php');
    require base_path('routes/dash/at/actas.php');

    require base_path('routes/dash/cap/capacitaciones.php');

    require base_path('routes/dash/otros/eventos.php');
    require base_path('routes/dash/otros/salidas.php');
    require base_path('routes/dash/otros/especialidades.php');

    


    // Subir Oferta
        Route::get('/oferta-at/{id}', function($id){
            $atconsultor = App\AtConsultor::find($id);
            $consultor = App\Consultor::find($atconsultor->consultor_id);
            return view('subiroferta', compact('consultor', 'atconsultor'));
        });

        Route::post('/oferta-at/{id}', 'ApiController@oferta');
    Route::get('/usuarios/auth', 'UsuarioController@auth');
    // Route::get('/capacitaciones', 'CapacitacionesController@index');
    // Route::get('/eventos', 'EventosController@index');

    require base_path('routes/dash/pdf.php');

    
});