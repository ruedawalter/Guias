<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="img-fluid " href="{{ url('home') }}">
                <img class="img-fluid" src="{{ asset('img/logo.png') }}" width="35" height="35"></a>
                <a class="navbar-brand"  href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-caret-square-o-right"></i>  {{ __('Login') }}</a>
                            </li>

                        @else

                            {{--  @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}

                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdowncliente" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Usuarios
                                <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if  (Auth::user()->id_rol == "3")
                                    <a class="dropdown-item" href="{{ url('register') }}"
                                       ><i class="fas fa-user-plus"></i>  Registrar</a>
                                    <a class="dropdown-item" href="{{ url('usuarios') }}"><i class="fas fa-user"></i>  Usuarios</a>
                                @endif

                                    <a class="dropdown-item" href="{{ route('password.request') }}"><i class="fas fa-refresh">  </i>  Restablecer contraseña</a>

                                </div>
                            </li> --}}


                            <li class="nav-item dropdown">
                                <a id="navbarDropdowncliente" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Sistema
                                <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if  (Auth::user()->id_rol == "3")
                                    {{-- <a class="dropdown-item" href="{{ url('agentes') }}"
                                       ><i class="fas fa-motorcycle"></i>  Agentes</a> --}}
                                    {{-- <a class="dropdown-item" href="{{ url('bancos') }}"><i class="fas fa-university"></i>  Bancos</a>
                                    <a class="dropdown-item" href="{{ url('distritos') }}"><i class="fas fa-map"></i>  Distritos</a> --}}
                                    <a class="dropdown-item" href="{{ url('estados') }}"><i class="fas fa-calendar-check-o"></i>  Estatus de la Guia</a>
                                    <a class="dropdown-item" href="{{ url('fpagos') }}"><i class="fas fa-credit-card"></i>  Formas de pago</a>
                                    <a class="dropdown-item" href="{{ url('servicios') }}"><i class="fas fa-bars"></i>  Servicios</a>

                                    {{-- <a class="dropdown-item" href="{{ url('register') }}"
                                       ><i class="fas fa-user-plus"></i>  Registrar</a> --}}
                                    <a class="dropdown-item" href="{{ url('usuarios') }}"><i class="fas fa-user"></i>  Usuarios</a>
                                @endif

                                @if  (Auth::user()->id_rol == "3" or Auth::user()->id_rol == "2" or Auth::user()->id_rol == "1")
                                    <a class="dropdown-item" href="{{ route('password.request') }}"><i class="fas fa-refresh">  </i>  Restablecer contraseña</a>
                                @endif
                                </div>
                            </li>

                            @if  (Auth::user()->id_rol == "3")

                            <li class="nav-item dropdown">
                                <a id="navbarDropdowncliente" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Clientes
                                <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('clientes') }}"
                                       ><i class="fas fa-plus" aria-hidden="true"></i><i class="fas fa-edit" aria-hidden="true"></i><i class="fas fa-male" aria-hidden="true"></i>  Crear/Editar</a>

                                </div>

                            </li>
                            @endif
                            @if  (Auth::user()->id_rol == "3")
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownproveedor" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Guias
                                <span class="caret"></span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('admguias') }}"
                                               ><i class="fas fa-plus" aria-hidden="true"></i><i class="fas fa-edit" aria-hidden="true"></i><i class="fas fa-truck" aria-hidden="true"></i>  Crear/Editar</a>
                                        </div>
                            </li>
                            @endif
                            @if  (Auth::user()->id_rol == "2")
                                <li class="nav-item dropdown">
                                <a id="navbarDropdownproveedor" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Guias
                                <span class="caret"></span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('remguias') }}"
                                               ><i class="fas fa-plus" aria-hidden="true"></i><i class="fas fa-edit" aria-hidden="true"></i><i class="fas fa-truck" aria-hidden="true"></i>  Crear/Editar</a>
                                        </div>
                                </li>
                            @endif
                            @if  (Auth::user()->id_rol == "1")
                                <li class="nav-item dropdown">
                                <a id="navbarDropdownproveedor" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Guias
                                <span class="caret"></span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('aguias') }}"
                                               ><i class="fas fa-plus" aria-hidden="true"></i><i class="fas fa-edit" aria-hidden="true"></i><i class="fas fa-truck" aria-hidden="true"></i>  Crear/Editar</a>
                                        </div>
                                </li>
                            @endif


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <i class="fas fa-user"></i>   {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>