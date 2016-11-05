<?php

// Terminos
route::get('pdf/tdr/{id}', function($id){
    $at = App\AtTermino::with('empresa')->find($id);
    $pdf = PDF::loadView('pdf.AtTermino',  compact('at'));
    return $pdf->stream();
});

// Oferta
route::get('pdf/oferta/{id}', function($oferta){
    return Redirect::to('ofertas/' . $oferta);
});


// Contrato
route::get('pdf/contrato/{id}', function($id){
    $at = App\AtTermino::find($id);
    $contrato = $at->contrato;
    $consultor = App\Consultor::find($at->consultor->consultor_id);
    $empresa = $at->empresa;
    // return $empresa;
    $ofertantes = $at->ofertantes;
    $empresario = App\Empresario::find($at->empresario_id);
    if($consultor->empresa)
        $consultor->denominacion = 'la empresa consultora';
    else
        $consultor->denominacion = ($consultor->sexo == 'Mujer'? 'la consultora': 'el consultor');

    $pdf = PDF::loadView('pdf.AtContrato',  compact('at', 'consultor', 'empresa', 'empresario', 'contrato','ofertantes'));
    return $pdf->stream();
});

// Ampliacion
route::get('pdf/ampliacion/{id}', function($id){


    $at = App\AtTermino::find($id);
    $ampliacion = $at->ampliacion;
    $nombre = $at->tema;
    if($ampliacion->solicitante == "Consultor")
        $solicitante = $at->consultorSeleccionado->consultor;
    else
        $solicitante =   App\Empresario::find($at->empresario_id);;
    $solicitante->calidad = $ampliacion->solicitante;

    $pdf = PDF::loadView('pdf.AtAmpliacion',  compact('ampliacion', 'nombre', 'solicitante'));
    return $pdf->stream();
});

// Acta
route::get('pdf/acta/{id}', function($idAt){

    $at = App\AtTermino::with('acta', 'contrato', 'empresa')
                    ->find($idAt);

    $empresa = App\Empresa::find($at->empresa_id);
    $consultor = App\consultor::find($at->consultor->consultor_id);
    $empresario = App\Empresario::find($at->empresario_id);
    $contrato = $at->contrato;
    $acta = $at->acta;

    // return $acta;

    $pdf = PDF::loadView('pdf.AtActa',  compact('at', 'consultor', 'empresa', 'empresario', 'contrato', 'acta'));
    return $pdf->stream();
});

// Aporte
route::get('pdf/aporte/{id}', function($id){

    $at = App\AtTermino::with('empresa', 'contrato', 'acta', 'empresa')->find($id);
    $consultor = App\consultor::find($at->consultor->consultor_id);
    $contrato   = $at->contrato;
    $pago = round($contrato->pagoEmpresario,2);
    $concepto = "Pago correspondiente al aporte empresarial por desarrollo de asistencia técnica denominada:";
    $concepto = $concepto . $at->tema;
    $fecha = $at->acta->fecha;
    $descuento = 0;
               
    date_default_timezone_set('America/El_Salvador');

    $time = time();
    $hora = date("g:i a", $time);
    $pdf = PDF::loadView('pdf.AtAporte',  compact('descuento','consultor', 'pago', 'concepto', 'fecha', 'consultor'));
    return $pdf->stream();
});

// Aporte
route::get('pdf/pagoaporte/{id}', function($id){

    $at = App\AtTermino::with('empresa', 'contrato', 'acta', 'empresa')->find($id);
    $contrato   = $at->contrato;
    $empresa   = $at->empresa;
    $pago = round($contrato->pagoEmpresario,2);
    $concepto = "Pago correspondiente al aporte empresarial del $at->aporte %
                    por desarrollo de asistencia técnica denominada: '";
    $concepto = $concepto . $at->tema;
    $concepto = $concepto . "' Para: " . $empresa->nombre;


    $pdf = PDF::loadView('pdf.AtPagoAporte',  compact('concepto', 'pago'));
    return $pdf->stream();
});

// Aporte
route::get('pdf/recepcion/{id}', function($id){

    $at = App\AtTermino::with('empresa', 'contrato', 'acta', 'empresa')->find($id);
    $consultor = App\consultor::find($at->consultor->consultor_id);
    $fecha       = $at->acta->fecha;
    $contrato   = $at->contrato;
    $empresa   = $at->empresa; 

    $servicio['tipo'] = "SERVICIOS DE ASISTENCIA TÉCNICA";
    $servicio['descripcion'] = "Asistencia técnica denominada: " . $at->tema . " para la empresa " . $empresa->nombre;
    $servicio['pago'] = $contrato->pagoCdmype;
    
    date_default_timezone_set('America/El_Salvador');

    $time = time();
    $hora = date("g:i a", $time);

    $pdf = PDF::loadView('pdf.AtRecepcionBienes',  compact('concepto', 'pago','fecha','servicio','consultor'));
    return $pdf->stream();
});



Route::get('at/{doc}', function($doc){
    return Redirect::to('informes/'. $doc);
});
