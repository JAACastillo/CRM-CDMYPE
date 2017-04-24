<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="#/"> CDMYPE </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="javascript: return false" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Clientes <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#/empresas"> Empresas </a>
                            <a href="#/empresarios"> Empresarios </a>
                        </li>
                    </ul>
                </li>

                <li><a href="#/consultores">Consultores</a></li>
                <li><a href="#/asistencias">Asistencias Tecnicas</a></li>
                <li><a href="#/capacitaciones">Capacitaciones</a></li>
                <li class="dropdown">
                    <a href="javascript: return false" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Otros <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#/eventos"> Eventos </a>
                            <a href="#/salidas"> Salidas </a>
                            <a href="#/materiales"> Materiales </a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="#/login">Login</a></li>
                    <li><a href="#/register">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="javascript: return false" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Salir
                                </a>

                                <form id="logout-form" action="#/logout" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>