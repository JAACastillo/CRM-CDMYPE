<?php

// Empresarios
Route::get('/empresarios', 'EmpresarioController@index');
Route::get('/empresario/{id}', 'EmpresarioController@buscar');
Route::post('/empresario/guardar', 'EmpresarioController@guardar');
Route::post('/empresario/eliminar/{id}', 'EmpresarioController@eliminar');



Route::post('/empresario/empresa', 'EmpresarioController@empresa');



	
