<?php


Route::get('configuraciones', ['as' => 'configuraciones', 'uses' => 'ConfiguracionController@index']);
Route::post('configuraciones', ['as' => 'actualizarConfiguraciones', 'uses' => 'ConfiguracionController@actualizarConfiguraciones']);