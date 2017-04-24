<?php

Route::resource('asesorias', 'asesoriasController');

Route::get('asesorias', ['as' => 'asesorias', 'uses' => 'asesoriasController@index']);

//devolver el material de las asesorias

Route::get('asesoria/material/{asesoria}', ['as' => 'materialAsesoria', 'uses' => 
	function($asesoria){
		return Redirect::to('assets/asesorias/' . $asesoria);
	}
	]);