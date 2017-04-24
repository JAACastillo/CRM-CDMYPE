<?php

// Ampliaciones
Route::get('/ampliaciones', 'At\AmpliacionController@index');
Route::get('/ampliacion/{id}', 'At\AmpliacionController@buscar');
Route::post('/ampliacion/guardar', 'At\AmpliacionController@guardar');
Route::post('/ampliacion/eliminar/{id}', 'At\AmpliacionController@eliminar');