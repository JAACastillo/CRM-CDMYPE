<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 20px}
	     #footer .left {float: left; text-align: center; border: none}
	     #footer .right {position: absolute; right: 10px; text-align: center; height: 250px; display: inline-block;}

	     .firmas {text-align: center;}
	     .firmas .firm { display: inline-block; position: absolute; }
	     .empresario {left: 40%}
	     .consultor {right: 0}

	     .clausula {color: #707070  }

	     .left{border: 1px solid #000; width: 45%; height: 250px; padding-left: 15px; display: inline-block;}
	     .leftBottom{border: 1px solid #000; width: 60%;  padding-left: 15px; padding-bottom: 15px; display: inline-block;}
	     .right{display: inline-block; padding-left: 50px}
	    #header { position: fixed; left: 0px; top: -80px; right: 0px; height: 100px; text-align: center; color:#bf8f00}
   		#footer { position: fixed; bottom: -160px; right: 0px; height: 150px; color:#bf8f00; font-size: 0.6em;border-top: 2px solid #bf8f00 }
    	#footer .page:after { content: counter(page, upper-roman); }
    	.linea {border-bottom: 1px solid black; padding-bottom: 5px;}
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
		// $cantidad = explode('.', '133.9');

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
			$cantidadEnLetras = $cantidadEnLetras . $y . $valoresString[$anchoCantidad - 1 -  $x][$num];//substr($cantidad[0], $x, $size)] ;
			// $cantidadEnLetras = $y . $valoresString[$anchoCantidad - 1 -  $x][substr($cantidad[0], $x, 1)] . ' ' . $cantidadEnLetras;
		}
		// dd($cantidad);
	?>

<div id="header">
    <img src="img/unicaes-logo.jpg" width="75px" class="right" style="position:fixed; left:-35px; top:-80px">
    	<h3 style="padding:0;margin:0;"> UNIVERSIDAD CATÓLICA DE EL SALVADOR</h3>
    	<P style="padding:0;margin:0;">http://www.catolica.edu/sv</P>
    
  </div>
  <div id="footer">
   	<p class="left">
   		Sede Santa Ana <br>
   		By Pass a Metapán, y carretera antigua a San Salvador <br>
   		Santa Ana, El Salvador. C. A. <br>
   		PBX (503) 2484-0600, Fax (503)2441-2655 <br>
   		e-mail: catolica@catolica.edu.sv
   	</p>
   	<p class="right">
   		<br>
   		Centro Regional Ilobasco <br>
   		Carretera a Ilobasco, Km 56, Cantón Agua Zarca <br>
   		Cabañas, El Salvador. C. A. <br>
   		Teléfono (503) 2384-2781<br>
   		e-mail: ilobasco@catolica.edu.sv
   	</p>
  </div>

<div id="contenido">
	<div style="position:absolute; right:10px"> POR:<b class="linea"> $ {{$pago}}</b> </div>
	<h5>
		RECIBÍ DE LA UNIVERSIDAD CATÓLICA DE EL SALVADOR, LA CANTIDAD DE:
	</h5>
	<b class="linea">
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
	</b>
	<br>
	<br>
		
	EN CONCEPTO DE: <b class="linea">{{$concepto}}.</b>

	<br>
	<br>

	ILOBASCO, <span class="linea">{{$dia}}</span> de <span class="linea">{{$mes}}</span> de {{$ano}}
	<br>

	<div style="height:300px; margin:20px 0; ">
		<div class="left" style="height:300px; padding-right:20px">
			<br>
				NOMBRE: <b class="linea">{{$consultor->nombre}}</b>
			<br>
			<br>
				DUI: <b class="linea">{{$consultor->dui}}</b>
			<br>
			<br>
				NIT: <b class="linea">{{$consultor->nit}}</b>
			<br>
			<br>
				DIRECCIÓN: 
					<b class="linea">
						{{$consultor->direccion}}, 
						{{$consultor->municipio->municipio}},
						{{$consultor->municipio->departamento->departamento}}.
					</b>
			<br>
			<br>
				TEL: <b class="linea">{{$consultor->celular}}</b>
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
				Devengado  = <b class="linea">$ {{$pago}}</b>
			<br>
				@if($consultor->empresa)
					ISR = $ -
					<?
						$descuento = 0
					?>
				@else
					ISR = $ <span class="linea">{{ $descuento = round(($pago / 1.13) * 0.1,2)}}</span>
				@endif
			<br>
				A PAGAR = <b class="linea">$ {{round($pago - $descuento,2)}}</b>
			<br>
		</div>
	</div>
</div>
</body>
</html>
