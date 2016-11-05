<!DOCTYPE html>
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
	     table{border-collapse: collapse}

	     .clausula {color: #707070  }
	   </style>

	<title>Acta de recepcion</title>
</head>
<body>

<div id="header" >
	<img src="img/cdmype-logo.jpg" width="150px"/>
</div>

<div id="footer">
	<img src="img/unicaes-logo.jpg" width="75px" class="left" />

	<img src="img/conamype-logo.jpg" width="150px" class="right" />

</div>

				<?php
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					$date = strtotime($fecha);
					$dia = date('d', $date);
					$mes = $meses[date('m', $date) - 1];
					$ano = date('Y', $date);



					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					$date = strtotime($fecha);
					$diaActa = date('d', $date);
					$mesActa = $meses[date('m', $date) - 1];
					$anoActa = date('Y', $date);
				?>

<div id="contenido">
	<h4 style="text-align:center">
		ACTA DE RECEPCIÓN DE BIENES Y SERVICIOS <br>
		"{{$servicio['tipo']}}"
	</h4>
	<br>
	<br>
		La Universidad Católica de El Salvador Centro Regional de Ilobasco sede Cabañas, el <b> día {{$dia}} de {{$mes}}
		de {{$ano}}</b>, hace constar que ha recibido a su entera satisfacción los servicios 
		@if($consultor->empresa)
			de la empresa consultora <b>{{$consultor->empresa }} </b> representada por 
		@elseif($consultor->sexo == 'Mujer')
			de la consultora
		@else
			del consultor
		@endif
		 <b>{{$consultor->nombre}}</b>, con
		DUI número {{$consultor->dui}}, de quién se obligó a entregar en un plazo y forma convenido los bienes y/o servicios que se
		detallan a continuación:
	<br>
	<br>
	<br>
	<table border="1" >
		<tr>
			<td>CANTIDAD</td>
			<td>DESCRIPCIÓN</td>
			<td>PRECIO <br> UNITARIO</td>
			<td>TOTAL</td>
		</tr>
		<tr>
			<td style="text-align:center"> 1</td>
			<td> {{$servicio['descripcion']}}</b></td>
			<td  style="text-align:center">$ {{round($servicio['pago'],2)}}</td>
			<td style="text-align:center">$ {{round($servicio['pago'],2)}}</td>
		</tr>
	</table>	
	<br>
	<br>

	Y para constancia de lo anterior, firmamos la presente en la ciudad de Ilobasco, departamento
	de Cabañas, a las 4:00pm, del {{$diaActa}} de {{$mesActa}} de {{$anoActa}}.

	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="firmas">
			<br><br><br><br>
		<div class="firm apoderado">
			Recibido por:_____________________		<br/>
			Téc. Carmen Yamileth Mercado Flores		<br/>
			Administrativo para Asistencia Técnicas y			<br/>
			Capacitaciones
		</div>
		
		<div class="firm consultor">
			F._____________________	<br/>
			{{$consultor->nombre}} <br/>
			@if($consultor->empresa)
				Representante de empresa<br>
				{{$consultor->empresa}}
			@elseif($consultor->sexo == 'Mujer')
				Consultora
			@else
				Consultor
			@endif
		</div>
	</div>
</div>
</body>
</html>
