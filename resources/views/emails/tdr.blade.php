<?php
    $cortar = explode("-",$at->fecha);
    $fecha = $cortar[2] . ' de ' . $cortar[1] . ' de ' . $cortar[0];
?>


<p style='text-align: justify'>
    El Centro de Desarrollo de la Micro y Pequeña Empresa, Centro Regional de Ilobasco (CDMYPE-UNICAES) a través de los servicios de ASISTENCIA TÉCNICA adjunta por este medio los términos de referencia para aplicar a la asistencia técnica denominada, <b>"{{ $at->tema }}"</b>.
    <br/><br/>
    En los siguientes enlaces se encuentran los formatos y el enlace para poder subir la oferta técnica y económica.
    <br>
    La fecha limite para la presentación de la oferta es <b>{{ $fecha }}</b>.
</p>

<br/>
<a href="{{ url('/pdf/tdr/'. $at->id) }}" target="_blank">TERMINOS DE REFENCIA (PDF)</a>
<br/>
<a href="{{ url('/docs/F7.docx') }}" target="_blank"> FORMATO OFERTA TÉCNICA Y ECONÓMICA (WORD) </a>
<br>
<a href="{{ url('/oferta-at/' . $consultor['id']) }}" target="_blank"> Subir Oferta </a>
<br>
<hr>
<br>
<img src="{{ url('/img/conamype-logo.jpg') }}" width="100px"/>
<img src="{{ url('/img/unicaes-logo.jpg') }}" width="70px"/>
<img src="{{ url('/img/cdmype-logo.jpg') }}" width="70px"/>
<br>
<b>Teléfono:</b> 2378-1500 Ext: (136)
