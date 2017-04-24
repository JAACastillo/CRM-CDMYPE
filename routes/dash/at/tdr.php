<?php

// TDR
    Route::get('/asistencias', 'At\TerminoController@index');
    Route::get('/asistencia/{id}', 'At\TerminoController@buscar');
    Route::post('/asistencia/guardar', 'At\TerminoController@guardar');
    Route::post('/asistencia/eliminar/{id}', 'At\TerminoController@eliminar');