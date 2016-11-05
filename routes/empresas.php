<?php

// Empresas
Route::get('/empresas', 'EmpresaController@index');
Route::get('/empresa/{id}', 'EmpresaController@buscar');
Route::post('/empresa/guardar', 'EmpresaController@guardar');
Route::post('/empresa/eliminar/{id}', 'EmpresaController@eliminar');


Route::get('/empresa/empresarios/{id}', 'EmpresaController@empresarios');
Route::get('/empresa/indicadores/{id}', 'EmpresaController@indicadores');
Route::get('/empresa/historial/{id}', 'EmpresaController@historial');
