<?php

Route::get('panel','panelController@index');

Route::get('panel/asesor/{id}', 'panelController@estadisticasAsesor');

Route::get('panel/grafica/{id}', 'panelController@grafica');