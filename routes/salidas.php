<?php


// Salidas
Route::get('/salidas', 'SalidaController@index');
Route::get('/salida/{id}', 'SalidaController@buscar');
Route::post('/salida/guardar', 'SalidaController@guardar');
Route::post('/salida/eliminar/{id}', 'SalidaController@eliminar');

   // Pdf

   Route::post('salidas/pdf/', ['as' => 'salidasPdf', 'uses' => 'SalidasController@pdf']);
