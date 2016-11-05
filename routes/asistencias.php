<?php

// Empresas
Route::get('/asistencias', 'AtTerminoController@index');
Route::get('/asistencia/{id}', 'AtTerminoController@buscar');
Route::post('/asistencia/guardar', 'AtTerminoController@guardar');
Route::post('/asistencia/eliminar/{id}', 'AtTerminoController@eliminar');


Route::post('/asistencia/enviartermino', 'AtTerminoController@enviarTDR');
Route::get('/asistencia/enviados/{id}', 'AtTerminoController@enviados');
Route::get('/asistencia/contrato/{id}', 'AtTerminoController@contrato');


// Contratos
Route::get('/contratos', 'AtContratoController@index');
Route::get('/contrato/{id}', 'AtContratoController@buscar');
Route::post('/contrato/guardar', 'AtContratoController@guardar');
Route::post('/contrato/eliminar/{id}', 'AtContratoController@eliminar');

// Actas
Route::get('/actas', 'ActaController@index');
Route::get('/acta/{id}', 'ActaController@buscar');
Route::post('/acta/guardar', 'ActaController@guardar');
Route::post('/acta/eliminar/{id}', 'ActaController@eliminar');
