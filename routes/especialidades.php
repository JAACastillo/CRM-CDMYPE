<?php

// Consultor
Route::get('/especialidades', 'EspecialidadController@index');
Route::get('/especialidades/{id}', 'EspecialidadController@buscar');
Route::post('/especialidades/guardar', 'EspecialidadController@guardar');
Route::post('/especialidades/eliminar/{id}', 'EspecialidadController@eliminar');