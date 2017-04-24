<?php

Route::get('/', function () {return view('page.home.index'); });
Route::get('/nosotros', function () {return view('page.nosotros.index'); });
Route::get('/servicios', function () {return view('page.servicios.index'); });
Route::get('/contactos', function () {return view('page.contactos.index'); });
Route::get('/noticias', function () {return view('page.noticias.index'); });
