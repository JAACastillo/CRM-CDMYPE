<?php

// Consultor
Route::get('/consultores', 'ConsultorController@index');
Route::get('/consultor/{id}', 'ConsultorController@buscar');
Route::post('/consultor/guardar', 'ConsultorController@guardar');
Route::post('/consultor/eliminar/{id}', 'ConsultorController@eliminar');

Route::get('/consultores/porespecialidad/{especialidad}', 'ConsultorController@byespecialidad');
Route::post('/consultor/especialidad', 'ConsultorController@agregarespecilidad');
Route::post('/consultor/delespecialidad/{id}', 'ConsultorController@quitarespecilidad');