<?php

   //Calendario
      Route::get('calendario', 'CalendarioController@eventos');

   //Agenda
      Route::get('agenda', 'CalendarioController@agenda');

      Route::post('agenda', 'CalendarioController@guardar');

      //Editar asesoria
      Route::get('agenda/asesoria/{id}', ['as' => 'verAsesoria', 'uses' => 'CalendarioController@asesoria']);
      Route::get('agenda/asesoria/editar/{id}', ['as' => 'editarAsesoria', 'uses' => 'CalendarioController@editarAsesoria']);
      Route::post('agenda/asesoria/editar/{id}', ['as' => 'editarAsesoria', 'uses' => 'CalendarioController@actualizarAsesoria']);

      //Editar reunion
      Route::get('agenda/reunion/{id}', ['as' => 'verReunion', 'uses' => 'CalendarioController@reunion']);
      Route::get('agenda/reunion/editar/{id}', ['as' => 'editarReunion', 'uses' => 'CalendarioController@editarReunion']);
      Route::post('agenda/reunion/editar/{id}', ['as' => 'editarReunion', 'uses' => 'CalendarioController@actualizarReunion']);


      //bitacora de seguimiento
      Route::get('agenda/bitacora/{id}', ['as' => 'bitacora', 'uses' => 'CalendarioController@bitacora']);