<!DOCTYPE html>
<html lang="es">
<head>
<head>
    <meta charset="UTF-8">
    <title>CDMYPE - @yield('titulo','Login')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
    <body class="hold-transition login-page">
        <div class="login-box">

            <div class="login-box-body text-center">

                <img src="img/cdmype-logo.jpg" alt="Logo" width="70%">

                <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>
            
                    @if (count($errors))
                      
                       @foreach($errors->all() as $error)
                           <p class="text-yellow">{{ $error }}</p>
                       @endforeach
                   @endif
                   <form role="form" method="POST" action="{{ url('/login') }}">
                       {!! csrf_field() !!}
                       {{-- Correo --}}
                       <div class="form-group has-feedback">
                           <input type="email" name="email" class="form-control" placeholder="Email" autofocus>
                           <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                       </div>
                       {{-- Pass --}}
                       <div class="form-group has-feedback">
                           <input type="password" name="password" class="form-control" placeholder="Password">
                           <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                       </div>
                       {{-- Remember --}}
                       <div class="checkbox form-group">
                           <label>
                               <br>
                               <input type="checkbox" name="remember"> Recordarme
                               <br>
                           </label>
                       </div>
                       {{-- Submit --}}
                       <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                   </form>

            </div>
            
        </div>

        <!-- JS -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>        

    </body>
</html>