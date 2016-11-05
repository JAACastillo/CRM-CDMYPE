<?php # http://www.lawebdelprogramador.com # tiene que recibir la hora inicial y la hora final
	function RestarHoras($horaini,$horafin) { $horai=substr($horaini,0,2); $mini=substr($horaini,3,2); $segi=substr($horaini,6,2); $horaf=substr($horafin,0,2); $minf=substr($horafin,3,2); $segf=substr($horafin,6,2); $ini=((($horai*60)*60)+($mini*60)+$segi); $fin=((($horaf*60)*60)+($minf*60)+$segf); $dif=$fin-$ini; $difh=floor($dif/3600); $difm=floor(($dif-($difh*3600))/60); $difs=$dif-($difm*60)-($difh*3600); return date("H:i",mktime($difh,$difm,$difs)); } ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	     #header { position: fixed; left: 0px; bottom: -130px; right: 0px; height: 120px;  }
	       #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }

	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 13px; line-height: 15px}
	     #header .left {position: absolute; float: left}
	     #header .right {position: absolute; right: 10px}

	      #footer .left {float: left}
	     #footer .right {position: absolute; right: 10px}

	     .titulo{text-align:center; margin-bottom:0px}
	     .table, th {border: 1px solid black; margin: 0px; padding: 2px; font-size: 10px;}
	     .table, td {border: 1px solid black; margin: 0px; padding: 2px; font-size: 13px;}
	     .titulo {float: left;}
	     .cafe {background-color: #E0EAF1; text-align: center;}


	     .sraya{border-bottom: 2px solid #000000; width: 100%; }
	     .text-left{text-align:left}

	     .borderRightNone{border-right: 1px solid #ffffff;}
	     .borderBottomNone{border-bottom: 1px solid #ffffff;}


	     .firmas .firm { display: inline-block; position: absolute; text-align: center;}
        .propietario {float: right; margin-left: -400px}
        .asesor {float: right; margin-left: 300; position: absolute;}

	   </style>

	<title>Bitacora de asesoria</title>
</head>
<body>

<div id="header" >
	<img src="assets/img/cdmype-logo.jpg" width="150px" />
</div>

<div id="footer">
	<img src="assets/img/conamype-logo.jpg" width="150px" class="left" />
	<img src="assets/img/unicaes-logo.jpg" width="75px" class="right" />
</div>


<h4 class="titulo">
		Bitácora de Asesoría de Campo
</h4>
<br>

<div id="contenido">
<table >
	<tr>
		<td width="320px">
			Fecha: <span class='raya' width="10px">  {{date("d-m-Y", strtotime($asesoria->fecha_inicio)); }} </span>
		</td>
		<td width="150px">
			Hora de llegada: <span class='raya'> {{date("g:i a", strtotime($asesoria->hora_inicio));}} </span>
		</td>
		<td width="150px">
			Hora de Salida: <span class='raya'>  {{date("g:i a", strtotime($asesoria->hora_fin));}} </span>
		</td>
	</tr>
	<tr>
		<td colspan="3" >
			Lugar de visita: <span class="raya">{{$asesoria->municipio->municipio}}</span>
		</td>
	</tr>
	<tr>
		<td colspan="3" >
			Asesor: <span class="raya">{{$asesoria->asesor->nombre}}</span>
		</td>
	</tr>
</table>


<br>
<table>
	<tr>
		<td colspan="4" class="cafe text-left" >
			Sesión de Salida
		</td>
	</tr>
	<tr>
		<td class="cafe borderRightNone">
			1. ¿Cuál es la naturaleza de la asesoría que le proporciona al cliente?.
		</td>
		<td>
			{{$asesoria->especialidades->especialidad}}
		</td><td class="cafe borderRightNone">
			2. ¿Situación del cliente?.
		</td>
		<td>
			{{$asesoria->tipo}}
		</td>
	</tr>
	<tr>
		<td class="cafe borderBottomNone">
			3. No. de personas que asistieron a la sesión
		</td>
		<td class="cafe borderBottomNone">
			4. Horas de preparación
		</td>
		<td class="cafe borderBottomNone">
			5. Horas de asesoría
		</td>
		<td class="cafe borderBottomNone">
			6. Horas de viaje
		</td>
	</tr>
	<tr >
		<td height="35px" >

		</td>
		<td >

		</td>
		<td style="text-align:center">
			<?php
				echo RestarHoras($asesoria->hora_inicio, $asesoria->hora_fin);
			?>
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td colspan="4" class="cafe text-left" >
			7. Antecedentes
		</td>
	</tr>
	<tr>
		<td colspan="4" class="text-left" height="100px" >

		</td>
	</tr>
	<tr>
		<td colspan="4" class="cafe text-left" >
			8. Resumen
		</td>
	</tr>
	<tr>
		<td colspan="4" class="text-left" height="100px" >
			{{$asesoria->detalle}}
		</td>
	</tr>
	<tr>
		<td colspan="4" class="cafe text-left" >
			9. Actividades del plan de acción
		</td>
	</tr>
	<tr>
		<td colspan="4" class="text-left" height="100px" >
			<dl>
				@if($asesoria->proyecto_id > 0)
					<dt>
						{{$asesoria->proyecto->nombre}}
						@if($asesoria->actividad > 0)
							<dd>
								{{$asesoria->actividad()->nombre}}
							</dd>
						@endif
					</dt>
				@endif
			</dl>
		</td>
	</tr>
</table>

<br><br><br><br><br>
<div class="firmas">
 <div class="firm propietario">
   <p>F.____________________________</p>
   <p>Nombre.____________________________</p>
   <p>Propietario o Representante</p>
 </div>
 <div class="firm asesor">
   <p>F.____________________________</p>
   <p>Firma Asesor CDMYPE</p>
 </div>
</div>

</div>
</body>
</html>








