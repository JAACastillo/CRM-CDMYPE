
<?php

//Creacion
Route::get('usuario/creacion', ['as' => 'crearUsuario', 'uses' => 'UserController@crearUsuario']);
Route::post('usuario/creacion', ['as' => 'guardarUsuario', 'uses' => 'UserController@guardarUsuario']);

//Edicion
Route::get('usuario/edicion/{idUsuario}', ['as' => 'editarUsuario', 'uses' => 'UserController@editarUsuario']);
Route::post('usuario/actualizacion/{idUsuario}', ['as' => 'actualizarUsuario', 'uses' => 'UserController@actualizarUsuario']);

//Ver
Route::get('usuario/{idUsuario}', ['as' => 'verUsuario', 'uses' => 'UserController@verUsuario']);

//Eliminar
Route::any('usuario/eliminacion/{idUsuario}', ['as' => 'eliminarUsuario', 'uses' => 'UserController@eliminarUsuario']);


// Route::any('usuarios', ['as' => 'usuarios', 'uses' => 'UserController@index']);