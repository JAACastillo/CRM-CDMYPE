<?php

// TDR
Route::get('/asistencias', 'AtTerminoController@index');
Route::get('/asistencia/{id}', 'AtTerminoController@buscar');
Route::post('/asistencia/guardar', 'AtTerminoController@guardar');
Route::post('/asistencia/eliminar/{id}', 'AtTerminoController@eliminar');

// Consultores
Route::post('/asistencia/enviartermino', 'AtTerminoController@enviarTDR');
Route::get('/asistencia/enviados/{id}', 'AtTerminoController@enviados');
Route::post('/asistencia/guardaroferta', 'AtTerminoController@oferta');
Route::post('/asistencia/eliminaroferta', 'AtTerminoController@quitaroferta');
Route::post('/asistencia/seleccionarconsultor', 'AtTerminoController@consultor');

Route::get('/asistencia/contrato/{id}', 'AtTerminoController@contrato');


// Contratos
Route::get('/contratos', 'AtContratoController@index');
Route::get('/contrato/{id}', 'AtContratoController@buscar');
Route::post('/contrato/guardar', 'AtContratoController@guardar');
Route::post('/contrato/eliminar/{id}', 'AtContratoController@eliminar');

// Ampliaciones
Route::get('/ampliaciones', 'AtAmpliacionController@index');
Route::get('/ampliacion/{id}', 'AtAmpliacionController@buscar');
Route::post('/ampliacion/guardar', 'AtAmpliacionController@guardar');
Route::post('/ampliacion/eliminar/{id}', 'AtAmpliacionController@eliminar');

// Actas
Route::get('/actas', 'ActaController@index');
Route::get('/acta/{id}', 'ActaController@buscar');
Route::post('/acta/guardar', 'ActaController@guardar');
Route::post('/acta/eliminar/{id}', 'ActaController@eliminar');
