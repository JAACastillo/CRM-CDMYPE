@extends('page.layout')

@section('content')

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <div id="map" data-position-latitude="13.8150407" data-position-longitude="-88.8625395"></div>
    <script>
      (function($) {
        $.fn.CustomMap = function(options) {

          var posLatitude = $('#map').data('position-latitude'),
            posLongitude = $('#map').data('position-longitude');

          var settings = $.extend({home: {latitude: posLatitude, longitude: posLongitude }, zoom: 17 }, options);

          var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

          return this.each(function() {
            var element = $(this);

            var options = {
              zoom: settings.zoom,
              center: coords,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              mapTypeControl: false,
              scaleControl: false,
              streetViewControl: false,
              panControl: true,
              disableDefaultUI: true,
              zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT
              },
              overviewMapControl: true,
            };

            var map = new google.maps.Map(element[0], options);

          });

        };
      }(jQuery));

      jQuery(document).ready(function() {
        jQuery('#map').CustomMap();
      });
    </script>


    <div id="content">
      <div class="container">

        <div class="row">

          <div class="col-md-8">

            <!-- Classic Heading -->
            <h4 class="classic-title"><span>Contactanos</span></h4>

            <!-- Start Contact Form -->
            <form role="form" class="contact-form" id="contact-form" method="post">
              <div class="form-group">
                <div class="controls">
                  <input type="text" placeholder="Nombre" name="nombre">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input type="email" class="email" placeholder="correo@ejemplo.com" name="correo">
                </div>
              </div>
              <div class="form-group">

                <div class="controls">
                  <textarea rows="7" placeholder="Mensaje" name="mensaje"></textarea>
                </div>
              </div>
              <button type="submit" id="submit" class="btn-system btn-large">Enviar</button>
              <div id="success" style="color:#34495e;"></div>
            </form>

          </div>

          <div class="col-md-4">

            <h4 class="classic-title"><span>Información</span></h4>
            <p>Comunicate con nosotros o visitanos en nuestras instalaciones</p>
            <div class="hr1" style="margin-bottom:10px;"></div>

            <ul class="icons-list">
              <li><i class="fa fa-map-marker"></i> Km. 51 1/2 Cantón Agua Zarca, Cabañas, El Salvador </li>
              <li><i class="fa fa-envelope-o"></i> cdmype.unicaes@gmail.com </li>
              <li><i class="fa fa-phone"></i> 2378-1500 Ext: (136) </li>
            </ul>
            
            <div class="hr1" style="margin-bottom:15px;"></div>

            <h4 class="classic-title"><span>Horarios de trabajo</span></h4>

            <ul class="list-unstyled">
              <li><strong>Lunes - Viernes</strong> - 8am a 5pm</li>
              <li><strong>Sábados</strong> - 8am to 12md</li>
            </ul>

          </div>

        </div>

      </div>
    </div>
    <!-- End content -->

@endsection