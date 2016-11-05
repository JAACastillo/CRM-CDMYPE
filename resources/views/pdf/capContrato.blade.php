<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	     #footer { position: fixed; left: 0px; bottom: -155px; right: 0px; height: 150px;  }
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 20px}
	     #footer .left {float: left}
	     #footer .right {position: absolute; right: 10px}
	     p {margin: 5px;}

	     .firmas {text-align: center; margin-top: 35px;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .apoderado {left: 37%}
	     .consultor {right: 0}

	     .clausula {color: #707070; margin: 0px; margin-bottom: 5px; margin-top: 15px; padding-bottom: 10px }
	     ul{padding: 0px; padding-left: 40px; margin: 0px}
	     ol{padding: 0px; padding-left: 40px; margin: 0px}
	   </style>

	<title>Contrato de trabajo</title>
</head>
<body>

<div id="header" >
	<img src="assets/img/cdmype-logo.jpg" width="150px"/>
</div>

<div id="footer">
	<img src="assets/img/conamype-logo.jpg" width="150px" class="left" />

	<img src="assets/img/unicaes-logo.jpg" width="75px" class="right" />

</div>

	<?php
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$date = strtotime($capacitacion->fecha);
		$dia = date('d', $date);
		$mes = $meses[date('m', $date) - 1];
		$ano = date('Y', $date);
	?>

<div id="contenido">
	<h4 style="text-align:center">
		CONTRATO PROFESIONAL ENTRE {{Mb_strtoupper($consultor->denominacion)}} Y EL CDMYPE PARA LA
		PRESTACIÓN DE SERVICIOS DE CAPACITACIÓN
	</h4>

	<p>
	NOSOTROS, UNIVERSIDAD CÁTOLICA DE EL SALVADOR, en su calidad de Centro de
	Desarrollo de la Micro y Pequeña Empresa CDMYPE y
	@if($consultor->empresa)
		la empresa {{$consultor->empresa}} con número de Registro Tributario {{$consultor->iva}}, representada por
	@endif
	
	{{$consultor->nombre}},	mayor de edad, de nacionalidad salvadoreña, del domicilio de {{$consultor->direccion}}
	con Documento Único de Identidad (DUI), número {{$consultor->dui}}, quien en adelante se denominará {{$consultor->denominacion}}
	, convenimos celebrar el presente contrato con el objeto de que realice a favor	y a satisfacción de: CDMYPE, UNICAES-Ilobasco, la capacitación denominada:
	{{ $capacitacion->tema}}, para un grupo de empresarios, ubicados en: los Departamentos de Cabañas, San Vicente y Cuscatlán.

	<p>Las partes sujetamos el contrato en referencia a las siguientes cláusulas:</p>


	<p class="clausula">PRIMERA: PRODUCTOS ESPERADOS </p>

	Los productos esperados a realizar por {{$consultor->denominacion}} son los siguientes de acuerdo a los solicitados en los TDR:

		<?php
			$productos = explode("\r\n", $capacitacion->productos)
		?>
		<ul >
			@foreach($productos as $producto)
				<li>
					{{$producto}}
				</li>
			@endforeach
		</ul>
	<p class="clausula"> SEGUNDA: PLAZO </p>
	<?php
		$h1 = (date("G",strtotime($capacitacion->hora_ini)));
		$h2 = (date("G",strtotime($capacitacion->hora_fin)));
		$horas = $h2 - $h1;
	?>

	El presente contrato tendrá una duración de OCHO HORAS, la capacitación brindada el dia {{$dia}} de {{$mes}} de {{$ano}}. Durante este período {{$consultor->denominacion}} se compromete a hacer cumplir las actividades objeto de este contrato contenidas en la oferta técnica y económica y a dar fiel cumplimiento a los compromisos establecidos en los planes de trabajo aprobados y productos esperados.

<br/>
	<p class="clausula">TERCERA: INFORMES </p>

	{{ucfirst($consultor->denominacion)}} se obliga a presentar en tiempo y forma al CDMYPE UNICAES el informe final de la capacitación brindada a los empresarios.

<br/>
	<p class="clausula">CUARTA: FORMA DE PAGO </p>

	El CDMYPE UNICAES, en virtud de este contrato, pagará a {{$consultor->denominacion}} en concepto de honorarios por la capacitación efectuada, la cantidad de $ {{$contrato->pago }} (INCLUYE IVA) que corresponde al 100% del costo total de la capacitación.

	No se reconocerá ninguna cantidad anticipadamente ni adicional. La forma de pago será: un solo
	pago al final de la capacitación.

	<p class="clausula">QUINTA: SELECCIÓN DE {{Mb_strtoupper($consultor->denominacion)}} </p>


	El CDMYPE, selecciona a {{$consultor->denominacion}}: {{$consultor->nombre}}, de los consultores que ofertaron según el siguiente listado:
		<ol>
			@foreach($capacitacion->ofertantes as $ofertante)
				<li>
					{{$ofertante->consultor->nombre}}
				</li>
			@endforeach
		</ol>

	<p class="clausula"> SEXTA: ESTIPULACIONES ESPECIALES. </p>

		<ol>
			<li>
				{{ucwords($consultor->denominacion)}} se obliga a guardar estricta confidencialidad sobre la información obtenida de los participantes.
			</li>
			<li>
				{{ucwords($consultor->denominacion)}} no podrá desarrollar más de 3 consultorías de manera simultánea.
			</li>
			<li>
				{{ucwords($consultor->denominacion)}} se obliga entregar un informe final al CDMYPE de la capacitación realizada.
			</li>
			<li>
				Al finalizar la capacitación, {{$consultor->denominacion}} presentará factura de consumidor final a nombre de
				CDMYPE-UNICAES, por la cantidad correspondiente al costo de la capacitación.
			</li>
			<li>
				Todos los precios detallados en el presente contrato, incluyen cualquier tipo de impuestos.
			</li>
		</ol>

	<p class="clausula">
		SEPTIMA: TERMINACIÓN.
		<br>
		<span style='color:#000000'>El contrato podrá darse por terminado según las causas siguientes:</span>
		<ol type="a">
			<li> Por común acuerdo entre las partes; </li>
			<li> a solicitud de una de las partes, por motivo de fuerza mayor debidamente justificado y aceptado por la otra; </li>
			<li> Si cualquiera de las partes incumpliere cualquier obligación derivada del presente contrato; </li>
			<li> por causas imprevistas que hicieren imposible obtener la capacitación contratada, dando aviso a la otra parte con quince días de anticipación a la fecha de suspensión del contrato; </li>
			<li> Por faltas a la ética profesional. </li>
		</ol>

		Cuando el contrato se dé por terminado por las razones descritas en los literales (a), (c) y (d) las cuales sean imputables a la(s) empresa (s) beneficiaria (s). El CDMYPE UNICAES, a su discreción, podrá reconocer a {{$consultor->denominacion}} los gastos razonables que hubiere efectuado, siempre que éstos estén justificados y se compruebe en forma fehaciente que corresponden al objeto de este contrato.

<br/>
			<p class="clausula"> OCTAVA: OBLIGACIONES DE LOS EMPRESARIOS. </p>
			<ol>
				<li>
					Facilitar toda la información que sea necesaria para efecto del desarrollo de la capacitación.
				</li>
				<li>
					Destinar el tiempo requerido para la ejecución de la capacitación.
				</li>
				<li>
					Implementar las recomendaciones realizadas por {{$consultor->denominacion}} para el logro de los objetivos de la
					capacitación.
				</li>
				<li>
					Acceder a la realización de la encuesta de evaluación de impacto del o los servicios recibidos.
				</li>
			</ol>

			<p class="clausula"> NOVENA: VIGENCIA, ORDEN DE INICIO</p>


			Este contrato entrará en vigencia a partir de la fecha de su firma y a partir de la misma autoriza a 
			{{$consultor->denominacion}} dar inicio a la capacitación.

			En fe de lo cual firmamos el presente contrato en original, en {{$contrato->lugar_firma}} a los {{$dia}} días del mes
			de {{$mes}} de {{$ano}}.
	</p>
	<br>
	<div class="firmas">
		<br><br><br><br><br><br><br>
		<div class="firm directora">
			F.________________________	<br/>
			@if($contrato->firma == "Directora")
				Msc.Yessenia Escobar de Hernández <br/>
				Directora<br/>
			@else
				Msc. Enrique Salamón Reyes Escobar <br/>
				Director <br />
			@endif
			CDMYPE UNICAES
		</div>
		<div class="firm apoderado">
			F.______________________	<br/>
			Lic. Roberto Antonio López <br/>
			Apoderado Especial Administrativo <br/>
			Universidad Católica de El Salvador
		</div>
		<div class="firm consultor">
			F.______________________	<br/>
			{{$consultor->nombre}} <br/>
			@if($consultor->sexo == 'Mujer')
				Consultora
			@else
				Consultor
			@endif
		</div>
	</div>
</div>
</body>
</html>






