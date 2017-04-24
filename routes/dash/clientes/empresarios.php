<?php

// Empresarios
Route::get('/empresarios', 'Clientes\EmpresarioController@index');
Route::get('/empresario/{id}', 'Clientes\EmpresarioController@buscar');
Route::post('/empresario/guardar', 'Clientes\EmpresarioController@guardar');
Route::post('/empresario/eliminar/{id}', 'Clientes\EmpresarioController@eliminar');



Route::post('/empresario/empresa', 'Clientes\EmpresarioController@empresa');



	
