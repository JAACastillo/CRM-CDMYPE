<?php

// Contratos
Route::get('/contratos', 'At\ContratoController@index');
Route::get('/contrato/{id}', 'At\ContratoController@buscar');
Route::post('/contrato/guardar', 'At\ContratoController@guardar');
Route::post('/contrato/eliminar/{id}', 'At\ContratoController@eliminar');