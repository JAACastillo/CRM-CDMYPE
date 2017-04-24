<!DOCTYPE html>
<html lang="es" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>Oferta AT</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
</head>
<body>

<div class="container" ng-controller="ATEnviadosCtrl">
    <div class="row text-center">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <br><br>
            <img src="{{ url('/img/cdmype-logo.jpg') }}" class="img-responsive" style="margin: auto;" />
            <br>
            
            <h2>{{$consultor->nombre}}</h2>
            @if ($atconsultor->doc_oferta)
                <p>Su oferta ya esta en revisión</p>
            @else
                <p>Seleccione su oferta</p>
                <form method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$atconsultor->id}}">
                    <input type="file" name="oferta" style="margin: auto;" >
                    <br>
                    <button class="btn btn-primary">Subir</button>
                </form>

            @endif

        </div>
    </div>
</div>
    
</body>
</html>