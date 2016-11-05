<<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #header {margin: 0px; position: fixed; left: 0px; top: -76px; right: 0px;  text-align: center; }
	     #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px;  }
	     #footer .page:after { content: counter(page, upper-roman); }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 20px}
	     #footer .left {float: left}
	     #footer .right {position: absolute; right: 10px}

	     .firmas {text-align: center;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .empresario {left: 40%}
	     .consultor {right: 0}

	     .clausula {color: #707070  }
	   </style>

	<title>Contrato de trabajo</title>
</head>
<body>

<div id="header" >
	<img src="img/cdmype-logo.jpg" width="150px"/>
</div>

<div id="footer">
	<img src="img/conamype-logo.jpg" width="150px" class="left" />

	<img src="img/unicaes-logo.jpg" width="75px" class="right" />

</div>

				<?php
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					$date = strtotime($acta->fecha);
					$dia = date('d', $date);
					$mes = $meses[date('m', $date) - 1];
					$ano = date('Y', $date);
				?>

<div id="contenido">
	<h4 style="text-align:center">
		ACTA DE CONFORMIDAD DE ASISTENCIA TÉCNICA
	</h4>
		<br>
		<br>
		En Ilobasco, {{$dia}} días del mes de {{$mes}} del año {{$ano}}
		<br>
		<br>
		<br>

		El sr(a). <strong>{{$empresario->nombre}}</strong>, {{$empresario->tipo}} 

		@if($empresario->nombre != $empresa->nombre)
			de <strong>{{$empresa->nombre}}</strong>, con
		@endif
		<br>
		DUI #{{$empresario->dui}}
		<br>
		NIT #{{$empresario->nit}}

		<br>
		<br>

		Declara
		@if ($acta->estado == "Conformidad")
			 <strong> aceptar a conformidad </strong>
		@else
			<strong> no aceptar  </strong>
		@endif
				<?php
					$date = strtotime($contrato->fecha_inicio);
					$dia = date('d', $date);
					$mes = $meses[date('m', $date) - 1];
					$ano = date('Y', $date);
				?>


		el trabajo realizado por
		@if($consultor->empresa)
			 la empresa consultora <b>{{$consultor->empresa }} </b> representada por 
		@elseif($consultor->consultor->sexo == 'Mujer')
			la consultora
		@else
			el consultor
		@endif

		<strong> {{$consultor->nombre}}</strong>, con número de NIT
		{{$consultor->nit}}, de acuerdo al contrato suscrito con fecha {{$dia}} de {{$mes}} de {{$ano}}
		y autoriza al <strong> CDMYPE Ilobasco</strong>, hacer efectivo el pago de la suma de <strong> US${{round($contrato->pagoCdmype,2)}} </strong> que
		corresponde el cofinanciamiento del programa 
		@if($contrato->pagoEmpresario > 0)
			y la suma <strong> US${{round($contrato->pagoEmpresario,2)}}</strong>, que corresponde al cofinanciamiento del aporte empresarial 
		@endif
		que ha entregado para la realización de la asistecia técnica
		denominada <strong> "{{$at->tema}}"</strong> de la cual firma de recibido el informe final.
	</p>
<br>
<br>
<br>
<br>
<br>
	<div class="firmas">
		<div class="firm empresario">
			F._____________________	<br/>
			{{$empresario->nombre}} <br/>
			NIT # {{$empresario->nit}} <br/>
			Empresario
		</div>
	</div>
</div>
</body>
</html>
