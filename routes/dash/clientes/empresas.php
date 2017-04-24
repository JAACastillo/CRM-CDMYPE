<?php

// Empresas
Route::get('/empresas', 'Clientes\EmpresaController@index');
Route::get('/empresa/{id}', 'Clientes\EmpresaController@buscar');
Route::get('/empresas/search/{txt}', 'Clientes\EmpresaController@search');
Route::post('/empresa/guardar', 'Clientes\EmpresaController@guardar');
Route::post('/empresa/eliminar/{id}', 'Clientes\EmpresaController@eliminar');

Route::post('/indicador/guardar', 'Clientes\IndicadorController@guardar');
Route::get('/empresa/historial/{id}', 'Clientes\EmpresaController@historial');
