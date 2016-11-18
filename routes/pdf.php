<?php

// Asistencias
    // Terminos
        route::get('pdf/tdr/{id}', function($id){
            $at = App\AtTermino::with('empresa')->find($id);
            $at->especificos = explode("\r\n", $at->obj_especifico);
            $at->productos = explode("\r\n", $at->productos);
            $pdf = PDF::loadView('pdf.ATs.AtTermino',  compact('at'));
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
            $empresario = App\Empresario::find($at->empresario_id);
            $empresa = $at->empresa;
            $ofertantes = $at->ofertantes;
            $at->productos = explode("\r\n", $at->productos);
            if($consultor->empresa)
                $consultor->denominacion = 'la empresa consultora';
            else
                $consultor->denominacion = ($consultor->sexo == 'Mujer'? 'la consultora': 'el consultor');

            $pdf = PDF::loadView('pdf.ATs.AtContrato',  compact('at', 'consultor', 'empresa', 'empresario', 'contrato','ofertantes'));
            return $pdf->stream();
        });

    // Ampliacion
        route::get('pdf/ampliacion/{id}', function($id){

            $at = App\AtTermino::find($id);
            $ampliacion = $at->ampliacion;
            $ampliacion->razonamientos = explode("\r\n", $ampliacion->razonamiento);

            if($ampliacion->solicitante == "Consultor")
                $solicitante = App\Consultor::find($at->consultor->consultor_id);
            else
                $solicitante =  App\Empresario::find($at->empresario_id);
            

            $pdf = PDF::loadView('pdf.ATs.AtAmpliacion',  compact('ampliacion', 'at', 'solicitante'));
            return $pdf->stream();
        });

    // Acta
        route::get('pdf/acta/{id}', function($id){

            $at = App\AtTermino::find($id);

            $empresa = App\Empresa::find($at->empresa_id);
            $empresario = App\Empresario::find($at->empresario_id);
            $consultor = App\consultor::find($at->consultor->consultor_id);
            $contrato = $at->contrato;
            $acta = $at->acta;

            $pdf = PDF::loadView('pdf.ATs.AtActa',  compact('at', 'consultor', 'empresa', 'empresario', 'contrato', 'acta'));
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
            $pdf = PDF::loadView('pdf.ATs.AtAporte',  compact('descuento','consultor', 'pago', 'concepto', 'fecha', 'consultor'));
            return $pdf->stream();
        });

    // Aporte
        route::get('pdf/recibo/{id}', function($id){

            $at = App\AtTermino::with('empresa', 'contrato', 'acta', 'empresa')->find($id);
            $contrato   = $at->contrato;
            $at->empresa   = $at->empresa->nombre;
            $at->pago = round($contrato->pagoEmpresario,2);
            $pdf = PDF::loadView('pdf.ATs.AtPagoAporte',  compact('at'));
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

        $pdf = PDF::loadView('pdf.ATs.AtRecepcionBienes',  compact('concepto', 'pago','fecha','servicio','consultor'));
        return $pdf->stream();
    });



    Route::get('at/{doc}', function($doc){
        return Redirect::to('informes/'. $doc);
    });

    Route::get('docs', function($doc){
        return response()->download($doc);
    });



// Eventos

    // Participantes
        route::get('pdf/evento/{id}', function($id){
            $evento = App\Evento::find($id);
            $asistencias = App\EventoEmpresarios::where("evento_id", $id)->with('empresarios')->get();
            $pdf = PDF::loadView('pdf.eventoParticipantes', compact('evento', 'asistencias'))->setPaper('letter','landscape');
            return $pdf->stream();
        });


// Salidas
    // Participantes
        route::get('pdf/salida/{ano}/{mes}/{firma}', function($ano, $mes, $firma){

            $salidas = App\Salida::whereRaw('YEAR(fecha_inicio) = ? and MONTH(fecha_inicio) = ?', [$ano, $mes])
                                ->orderBy('fecha_inicio', 'ASC')
                                ->get();

            $pdf = PDF::loadView('pdf.salidas', compact('salidas', 'ano', 'mes', 'firma'))->setPaper('letter','landscape');

            return $pdf->stream();
        });
