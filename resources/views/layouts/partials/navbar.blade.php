<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

        @can('sucursales.index')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Sucursales</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                    @can('sucursales.index')
                    <li><a href="{{ route('sucursales.index') }}" class="dropdown-item"><i class="fas fa-list-alt"></i> Lista</a></li>
                    @endcan
                    @can('sucursal_usuario.index')
                    <li><a href="{{ route('sucursales_usuarios.index') }}" class="dropdown-item"><i class="fas fa-list-alt"></i> Asignación</a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('dropdown.personas')
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Arquitectos</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                <!-- == -->
                @can('personas.index')
                <li><a href="{{route('personas.index')}}" class="dropdown-item"><i class="fas fa-users"></i> Arquitectos</a></li>
                @endcan
                <li class="dropdown-divider"></li>
                <li><a href="{{route('exportExcel')}}" class="dropdown-item"><i class="fas fa-file-excel"></i> Arqtutectos.Excel</a></li>
                <li><a href="{{route('exportPDF')}}" class="dropdown-item" target="_blank"><i class="fas fa-file-pdf"></i> Arqtutectos.PDF</a></li>
            </ul>
        </li>
        @endcan

        @can('dropdown.configuraciones')
            <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Configuraciones</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                {{-- @can('tipopago.index')
                <li><a href="{{route('tipopagos.index')}}" class="dropdown-item"><i class="fas fa-user-cog"></i> Tipos de Pago</a></li>
                @endcan --}}
                @can('tiposervicio.index')
                <li><a href="{{route('tiposervicios.index')}}" class="dropdown-item"><i class="fas fa-user-cog"></i> Tipos de trámites</a></li>
                @endcan
                {{-- @can('tiposervicio.index') --}}
                <li><a href="{{route('gestiones.index')}}" class="dropdown-item"><i class="fas fa-calendar"></i> Gestiones</a></li>
                {{-- @endcan --}}
                <li class="dropdown-divider"></li>
                @can('categoria_general.index')
                <li><a href="{{route('categoriageneral.index')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Viviendas, Servicios, Oficinas, Industrias</a></li>
                @endcan
                @can('categoria_urbanizacion.index')
                <li><a href="{{route('categoriaurbanizacion.index')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Urbanizaciones</a></li>
                @endcan
                <li class="dropdown-divider"></li>
                @can('categoria_general.index')
                <li><a href="{{ route('galerias.index') }}" class="dropdown-item"><i class="far fa-images"></i> Galería</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        <!-- == -->
        @can('dropdown.reportes')
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reportes</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                <li><a href="{{route('reportes.proyectos')}}" class="dropdown-item"><i class="fas fa-folder-open"></i> Proyectos</a></li>
                <li><a href="{{route('reportes.ventas')}}" class="dropdown-item"><i class="fas fa-folder-open"></i> Ventas de carpeta</a></li>
                <li><a href="{{route('reportes.mensualidades')}}" class="dropdown-item"><i class="fas fa-folder-open"></i> Pago de mensualidades</a></li>
                <li><a href="{{route('indexplanillas')}}" class="dropdown-item"><i class="fas fa-folder-open"></i> Planilla de Ingresos</a></li>
            </ul>
        </li>
        @endcan

        @can('users.index')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Seguridad</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                    @can('users.index')
                    <li><a href="{{ route('users.index') }}" class="dropdown-item"><i class="fas fa-list-alt"></i> Usuarios</a></li>
                    @endcan
                    @can('roles.index')
                    <li><a href="{{ route('roles.index') }}" class="dropdown-item"><i class="fas fa-list-alt"></i> Roles</a></li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrase') }}</a>
                </li>
            @endif --}}
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Hola, {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #BBDEBF">
                    {{-- <a class="dropdown-item" href="{{ route('deudores_pdf') }}" target="_blank"><i class="fas fa-bell"></i> Deudores</a>
                    <a class="dropdown-item" href="{{ route('perfilusuario.index') }}"><i class="fas fa-user-circle"></i> Perfil Usuario</a> --}}
                    
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Cerra Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>