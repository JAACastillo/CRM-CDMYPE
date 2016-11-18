<?php

// Empresas
Route::get('/empresas', 'EmpresaController@index');
Route::get('/empresa/{id}', 'EmpresaController@buscar');
Route::get('/empresas/search/{txt}', 'EmpresaController@search');
Route::post('/empresa/guardar', 'EmpresaController@guardar');
Route::post('/empresa/eliminar/{id}', 'EmpresaController@eliminar');

Route::post('/indicador/guardar', 'IndicadorController@guardar');
Route::get('/empresa/historial/{id}', 'EmpresaController@historial');
