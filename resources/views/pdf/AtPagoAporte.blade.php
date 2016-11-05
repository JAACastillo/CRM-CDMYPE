<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	     @page { margin: 100px 90px; }
	     #contenido {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 40px}
	</style>

	<title>Recibo</title>
</head>
<body>

	

<div id="contenido">
	<div style="position:absolute; right:10px">POR: $ {{$pago}}</div>
	
	<br>
	<br>
		
	EN CONCEPTO DE: <b>{{$concepto}}</b>

	<br>
	<br>
</div>
</body>
</html>
