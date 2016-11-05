<?php

   Route::resource('salidas', 'SalidasController');

   // Pdf

   Route::post('salidas/pdf/', ['as' => 'salidasPdf', 'uses' => 'SalidasController@pdf']);
