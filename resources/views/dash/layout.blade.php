<!DOCTYPE html>
<html lang="es" ng-app="app" ng-controller="HeaderCtrl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDMYPE - @{{titulo}}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="{{ asset('js/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('js/DataTables/angular/css/angular-datatables.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/_all-skins.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-route.min.js') }}"></script>
    
    <script src="{{ asset('app/app.js') }}"></script>

    <script src="{{ asset('app/controllers.js') }}"></script>
    <script src="{{ asset('app/filters.js') }}"></script>
    <script src="{{ asset('app/directives.js') }}"></script>
    <script src="{{ asset('app/services.js') }}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div>
        @include('dash.menu')

        <div class="container">
            <section class="content-header">
                <h1> <span ng-bind="titulo"></span> <small ng-bind="subtitulo"></small> </h1>
                
                <ol class="breadcrumb">
                  <li>
                    <a href="#"><i class="fa fa-oard"></i> Home</a>
                  </li>
                  <li class="active" ng-bind="titulo"></li>
                </ol>
            </section>
            <section class="content"> 
                <div ng-view></div>
            </section>
        </div>

    </div>

    <div class="modal fade" id="previsualizar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="tituloModal"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="myModalBandera">
                      <div class="row">
                        <div class="col-xs-12">
                        <textarea name="texto" id="texto" class="form-control" cols="30" rows="12" placeholder="Introduzca el texto..." autofocus></textarea>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" closeprevisualizar>Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/classie.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/ui-bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/ui-chart.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimScroll.min.js') }}"></script>
    
    <script src="{{ asset('js/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/DataTables/angular/angular-datatables.min.js') }}"></script>
    <script src="{{ asset('js/DataTables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/DataTables/jszip.min.js') }}"></script>
    <script src="{{ asset('js/DataTables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/DataTables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/DataTables/angular/plugins/buttons/angular-datatables.buttons.min.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/ui-calendar.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>

    <script>angular.module('app').constant("CSRF_TOKEN", '{{ csrf_token() }}')</script>
    <script src="/js/app.js"></script>
</body>
</html>
