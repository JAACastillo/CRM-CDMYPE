    <div class="hidden-header"></div>
    <header class="clearfix">

      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <ul class="contact-details">
                <li><a href="#"><i class="fa fa-map-marker"></i> Km. 51 1/2 Cantón Agua Zarca, Cabañas, El Salvador</a>
                </li>
                <li><a href="emailto:cdmype.unicaes@gmail.com"><i class="fa fa-envelope-o"></i> cdmype.unicaes@gmail.com</a>
                </li>
                <li><a href="tel:+5032378-1500"><i class="fa fa-phone"></i> 2378-1500 Ext: (136) </a>
                </li>
              </ul>
            </div>
            <div class="col-md-5">
              <ul class="social-list">
                <li>
                  <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a class="instagram itl-tooltip" data-placement="bottom" title="Instagram" href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                  <a class="youtube itl-tooltip" data-placement="bottom" title="youtube" href="#"><i class="fa fa-youtube"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="navbar navbar-default navbar-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" style="width: 120px;">
              <img alt="" src="img/cdmype-logo.jpg">
            </a>
          </div>
          <div class="navbar-collapse collapse">
            {{-- <div class="search-side">
              <a class="show-search"><i class="fa fa-search"></i></a>
              <div class="search-form">
                <form autocomplete="off" role="search" method="get" class="searchform" action="#">
                  <input type="text" value="" name="s" id="s" placeholder="Search the site...">
                </form>
              </div>
            </div> --}}
            <ul class="nav navbar-nav navbar-right">
              <li><a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a> </li>
              <li><a class="{{ Request::is('nosotros') ? 'active' : '' }}" href="{{ url('/nosotros') }}">Nosotros</a> <li>
              <li><a class="{{ Request::is('servicios') ? 'active' : '' }}" href="{{ url('/servicios') }}">Servicios</a> <li>
              <li><a class="{{ Request::is('contactos') ? 'active' : '' }}" href="{{ url('/contactos') }}">Contactos</a> </li>
              <li><a class="{{ Request::is('pasantias') ? 'active' : '' }}" href="{{ url('/pasantias') }}">Pasantias</a> </li>
              <li><a class="{{ Request::is('noticias') ? 'active' : '' }}" href="{{ url('/noticias') }}">Noticias</a> </li>
            </ul>
          </div>
        </div>
        <ul class="wpb-mobile-menu">
              <li><a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a> </li>
              <li><a class="{{ Request::is('nosotros') ? 'active' : '' }}" href="{{ url('/nosotros') }}">Nosotros</a> <li>
              <li><a class="{{ Request::is('servicios') ? 'active' : '' }}" href="{{ url('/servicios') }}">Servicios</a> <li>
              <li><a class="{{ Request::is('contactos') ? 'active' : '' }}" href="{{ url('/contactos') }}">Contactos</a> </li>
              <li><a class="{{ Request::is('pasantias') ? 'active' : '' }}" href="{{ url('/pasantias') }}">Pasantias</a> </li>
              <li><a class="{{ Request::is('noticias') ? 'active' : '' }}" href="{{ url('/noticias') }}">Noticias</a> </li>
        </ul>
      </div>
    </header>
