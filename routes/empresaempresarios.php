<?php

// Empresas
Route::get('/empresa/empresarios/{id}', 'EmpresaEmpresarioController@byEmpresa');
Route::get('/empresario/empresas/{id}', 'EmpresaEmpresarioController@byEmpresario');
Route::post('/empresaempresario/guardar', 'EmpresaEmpresarioController@guardar');
Route::post('/empresaempresario/eliminar/{id}', 'EmpresaEmpresarioController@eliminar');