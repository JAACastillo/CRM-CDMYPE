<?php

// Consultores
Route::post('/asistencia/enviartermino', 'At\TerminoController@enviarTDR');
Route::get('/asistencia/enviados/{id}', 'At\TerminoController@enviados');
Route::post('/asistencia/guardaroferta', 'At\TerminoController@oferta');
Route::post('/asistencia/eliminaroferta', 'At\TerminoController@quitaroferta');
Route::post('/asistencia/seleccionarconsultor', 'At\TerminoController@consultor');

Route::get('/asistencia/contrato/{id}', 'At\TerminoController@contrato');