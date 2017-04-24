<?php

// Consultor
Route::get('/especialidades', 'Otros\EspecialidadController@index');
Route::get('/especialidades/{id}', 'Otros\EspecialidadController@buscar');
Route::post('/especialidades/guardar', 'Otros\EspecialidadController@guardar');
Route::post('/especialidades/eliminar/{id}', 'Otros\EspecialidadController@eliminar');