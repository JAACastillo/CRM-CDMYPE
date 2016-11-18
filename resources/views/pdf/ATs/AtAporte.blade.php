<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<meta charset="utf-8">
	<style>
	     @page { margin: 100px 90px; }
		header {margin: 0px; position: fixed; left: 0px; top: -86px; right: 0px;  text-align: center; color:#bf8f00}
		#titulo{background-color: #CCFAE0; border: 2px solid black; text-align: center;}
		section {font-family: "arial black" ; margin: 0px; padding: 0px; font-size: 14px; line-height: 20px; text-align: left;}
		footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px; font-size: 0.6em;border-top: 2px solid #bf8f00  }
		footer .page:after { content: counter(page, upper-roman); }
		footer #unicaes {position: absolute; left: 10px;}
		footer #cri {position: absolute; right: 10px;}

	     .firmas {text-align: center;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .empresario {left: 40%}
	     .consultor {right: 0}

	     .left{border: 1px solid #000; width: 45%; height: 250px; padding-left: 15px; display: inline-block;}
	     .leftBottom{border: 1px solid #000; width: 60%;  padding-left: 15px; padding-bottom: 15px; display: inline-block;}
	     .right{display: inline-block; padding-left: 50px}
	   </style>

	<title>Recibo</title>
</head>
<body>

	<?php
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$date = strtotime($fecha);
		$dia = date('d', $date);
		$mes = $meses[date('m', $date) - 1];
		$ano = date('Y', $date); 
				
		$cantidad = explode('.', round($pago,2));

		$valoresString = 
		array(
			array('','Uno','Dos','Tres', 'Cuatro', 'Cinco', 'Seis', 'Siete', 'Ocho', 'Nueve', 'Diez', 'Once','Doce', 'Trece', 'Catorce', 'Quince', 'Dieciséis', 'Diecisiete', 'Dieciocho', 'Diecinueve'),
			array('','Diez','Veinte','Treinta', 'Cuarenta', 'Cincuenta', 'Sesenta', 'Setenta', 'Ochenta', 'Noventa'),
			array('','Ciento','Doscientos','Trescientos', 'Cuatrocientos', 'Quinientos', 'Seiscientos', 'Setecientos', 'Ochocientos', 'Novecientos')
		);
		$cantidadEnLetras  = "";
		$anchoCantidad = strlen($cantidad[0]);
		for ($x =  0; $x  < $anchoCantidad; $x++) { 
			# code...
			$size = 1;
			$y = ' ';
			if($x == $anchoCantidad - 1 && substr($cantidad[0], $x, 1) != '0' && $num != '0'){
				$y = ' y ';
			}
			if($x == $anchoCantidad - 2 && substr($cantidad[0], $x, 1) == '1'){
				$num = substr($cantidad[0], $x, 2);
				$size = 2;
				$x = $anchoCantidad -1;
			}
			else		{
				$num = substr($cantidad[0], $x, 1);
			}
			$cantidadEnLetras = $cantidadEnLetras . $y . $valoresString[$anchoCantidad - 1 -  $x][$num];
		}
	?>

<header>
    <img src="img/unicaes-logo.jpg" width="75px" class="right" style="position:fixed; left:-35px; top:-80px">
    	<h3 style="padding:0;margin:0;"> UNIVERSIDAD CATÓLICA DE EL SALVADOR</h3>
    	<P style="padding:0;margin:0;">http://www.catolica.edu/sv</P>
</header>
<footer>
	<p id="unicaes">
		Sede Santa Ana <br>
		By Pass a Metapán, y carretera antigua a San Salvador <br>
		Santa Ana, El Salvador. C. A. <br>
		PBX (503) 2484-0600, Fax (503)2441-2655 <br>
		e-mail: catolica@catolica.edu.sv
	</p>
	<p id="cri">
		Centro Regional Ilobasco <br>
		Carretera a Ilobasco, Km 56, Cantón Agua Zarca <br>
		Cabañas, El Salvador. C. A. <br>
		Teléfono (503) 2384-2781<br>
		e-mail: ilobasco@catolica.edu.sv
	</p>
</footer>

<div id="contenido">
	<div style="position:absolute; right:10px"> POR: <b> <u>$ {{$pago}}</u></b> </div>
	<h5>
		RECIBÍ DE LA UNIVERSIDAD CATÓLICA DE EL SALVADOR, LA CANTIDAD DE:
	</h5>
	<b><u>
		{{$cantidadEnLetras}} 
		@if(count($cantidad) > 1)
			@if(strlen($cantidad[1]) > 1)	
				{{$cantidad[1]}}/100
			@else
				{{$cantidad[1]}}0/100
			@endif
		@else
			00/100
		@endif
		dólares
	</u></b>
	<br>
	<br>
		
	EN CONCEPTO DE: <b><u>{{$concepto}}.</u></b>

	<br>
	<br>

	ILOBASCO, <u>{{$dia}}</u> de <u>{{$mes}}</u> de {{$ano}}
	<br>

	<div style="height:300px; margin:20px 0; ">
		<div class="left" style="height:300px; padding-right:20px">
			<br>
				NOMBRE: <b > <u>{{$consultor->nombre}}</u></b>
			<br>
			<br>
				DUI: <b > <u>{{$consultor->dui}}</u></b>
			<br>
			<br>
				NIT: <b > <u>{{$consultor->nit}}</u></b>
			<br>
			<br>
				DIRECCIÓN: 
					<b > <u>
						{{$consultor->direccion}}, 
						{{$consultor->municipio->municipio}},
						{{$consultor->municipio->departamento->departamento}}.
						</u>
					</b>
			<br>
			<br>
				TEL: <b > <u>{{$consultor->celular}}</u></b>
		</div>
		<div class="right">
			<br> <br>
			<p style="width:270px; text-align:center" class='linea'>
				{{$consultor->nombre}}
			<p style="text-align:center; width:270px;"> NOMBRE  </p>
			</p>
			<br>
			<br>
			<br>
			<br>
			______________________________________
			<p style="margin-left:110px; margin-top:5px;"> FIRMA </p>
		</div>
	</div>
	<div style="margin:0px">
		<div class="leftBottom">
			<br>
				UNIVERSIDAD CATÓLICA DE EL SALVADOR
			<br>
			<br>
				CENTRO REGIONAL DE ILOBASCO
			<br>
			<br>
				NIT: 0210-250682-001-7     NRC: 26024-0
			<br>
			<br>
				CARRETERA A ILOBASCO KM. 56 CANTON AGUA ZARCA, CABAÑAS, EL SALVADOR, C.A.
		</div>
		<div class="right">
				Devengado  = <b > <u>$ {{$pago}}</u></b>
			<br>
				@if($consultor->empresa)
					ISR = $ -
					<?
						$descuento = 0
					?>
				@else
					ISR = $ <u>{{ $descuento = round(($pago / 1.13) * 0.1,2)}}</u>
				@endif
			<br>
				A PAGAR = <b ><u>$ {{round($pago - $descuento,2)}}</u></b>
			<br>
		</div>
	</div>
</div>
</body>
</html>
