<?php

// Actas
Route::get('/actas', 'ActaController@index');
Route::get('/acta/{id}', 'ActaController@buscar');
Route::post('/acta/guardar', 'ActaController@guardar');
Route::post('/acta/eliminar/{id}', 'ActaController@eliminar');
