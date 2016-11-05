<?php

Route::resource('eventos', 'EventosController');


Route::get('eventos/participantes/{idEvento}',
			[
				'as' => 'eventosParticipantes',
				'uses' => 'EventosController@participantes'
			 ]);
Route::post('eventos/participantes/{idEvento}',
			[
				'as' => 'eventosParticipantes',
				'uses' => 'EventosController@participantesGuardar'
			 ]);
Route::get('eventos/participantes/pdf/{idEvento}',
			[
				'as' => 'eventosParticipantesPdf',
				'uses' => 'EventosController@participantesPDF'
			 ]);
Route::post('eventos/participantes/correo/{id}',
			[
				'as' => 'eventosParticipantesCorreo',
				'uses' => 'EventosController@participantesCorreo'
			 ]);
