<?php


// Eventos
Route::get('/eventos', 'EventoController@index');
Route::get('/evento/{id}', 'EventoController@buscar');
Route::post('/evento/guardar', 'EventoController@guardar');
Route::post('/evento/eliminar/{id}', 'EventoController@eliminar');

// Participantes
Route::get('/participantes', 'ParticipanteEventoController@index');
Route::get('/participante/{id}', 'ParticipanteEventoController@buscar');
Route::post('/participante/guardar', 'ParticipanteEventoController@guardar');
Route::post('/participante/eliminar/{id}', 'ParticipanteEventoController@eliminar');

// Correo
Route::post('/participante/correo', 'ParticipanteEventoController@eliminar');
