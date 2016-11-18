<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<style>
	    @page { margin: 100px 90px; }
	    section {font-family: "arial black" ;margin: 0px; padding: 0px; text-align:justify; font-size: 14px; line-height: 40px}
	</style>

	<title>Recibo</title>
</head>
<body>

	<section>
		<div style="position:absolute; right:10px">POR: <b>$ {{$at->pago}}</b></div>
		
		<br>
		<br>
			
		EN CONCEPTO DE: <br>
		Pago correspondiente al aporte empresarial del <b>{{$at->aporte}} % </b>
		por desarrollo de asistencia técnica denominada: <b>"{{$at->tema}}"</b> <br>
		Para: <b>{{$at->empresa}}</b>.


	    

	</section>

</body>
</html>
