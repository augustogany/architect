<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- == -->
                        @can('users.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">Usuarios</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('roles.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('sucursales.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('sucursales.index')}}">Sucursales</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('sucursal_usuario.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('sucursales_usuarios.index')}}">Asignación Sucursales</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('dropdown.categorias')
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Categorias</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                <!-- == -->
                                @can('categoria_general.index')
                                <li><a href="{{route('categoriageneral.index')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Viviendas, Servicios, Oficinas, Industrias</a></li>
                                @endcan
                                <!-- == -->
                                <li class="dropdown-divider"></li>
                                <!-- == -->
                                @can('categoria_urbanizacion.index')
                                <li><a href="{{route('categoriaurbanizacion.index')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Urbanizaciones</a></li>
                                @endcan
                                <!-- == -->
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
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
                                <li><a href="{{route('deudaarquitectos.index')}}" class="dropdown-item"><i class="fas fa-cash-register"></i> Deuda Arquitecto</a></li>
                                <li><a href="{{route('ventaservicio.index')}}" class="dropdown-item"><i class="fas fa-cash-register"></i> Venta de Servicios</a></li>
                                <!-- == -->
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('dropdown.proyectos')
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Proyectos</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                <!-- == -->
                                @can('proyecto_general.index')
                                <li><a href="{{route('proyectogeneral.index')}}" class="dropdown-item"><i class="fas fa-folder-open"></i> Viviendas, Servicios, Oficinas, Industrias</a></li>
                                @endcan
                                <!-- == -->
                                <li class="dropdown-divider"></li>
                                <!-- == -->
                                @can('proyecto_urbanizacion.index')
                                <li><a href="{{route('proyectourbanizacion.index')}}" class="dropdown-item"><i class="fas fa-folder-open"></i> Urbanizaciones</a></li>
                                @endcan
                                <!-- == -->
                                
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
                        {{-- @can('dropdown.reportes')
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reportes</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF"> --}}
                                <!-- == -->
                                {{-- <li><a href="" class="dropdown-item"><strong>Proyectos Generales</strong></a></li>
                                <li><a href="{{route('pg_por_rango_de_fechas_view')}}" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Por: Rango de Fechas</a></li>
                                <li><a href="{{route('pg_por_arquitectos_view')}}" class="dropdown-item"><i class="fas fa-user-check"></i> Por: Arquitectos</a></li>
                                <li><a href="{{route('pg_por_categorias_view')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Por: Categorías</a></li>
                                <li class="dropdown-divider"></li> --}}
                                <!-- == -->
                                {{-- <li><a href="" class="dropdown-item"><strong>Proyectos Urbanizaciones</strong></a></li>
                                <li><a href="{{route('pu_por_rango_de_fechas_view')}}" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Por: Rango de Fechas</a></li>
                                <li><a href="{{route('pu_por_arquitectos_view')}}" class="dropdown-item"><i class="fas fa-user-check"></i> Por: Arquitectos</a></li>
                                <li><a href="{{route('pu_por_categorias_view')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Por: Categorías</a></li>
                                <li class="dropdown-divider"></li> --}}
                                <!-- == -->
                                {{-- <li><a href="{{route('pagodeuda_rangofecha_view')}}" class="dropdown-item"><i class="fas fa-money-check"></i> Pago Deudas</a></li>
                                <li><a href="{{route('ventaservicio_rangofecha_view')}}" class="dropdown-item"><i class="fas fa-shopping-cart"></i> Ventas</a></li>
                            </ul>
                        </li>
                        @endcan --}}
                        <!-- == -->
                        @can('invitado.index')
                        <li class="nav-item">
                            <a href="{{route('visitante')}}" class="nav-link">Aviso del Sistema</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('dropdown.reportes')
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reportes</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Proy. Generales</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                        <li><a href="{{route('pg_por_rango_de_fechas_view')}}" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Por: Rango de Fechas</a></li>
                                        <li><a href="{{route('pg_por_arquitectos_view')}}" class="dropdown-item"><i class="fas fa-user-check"></i> Por: Arquitectos</a></li>
                                        <li><a href="{{route('pg_por_categorias_view')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Por: Categorías</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-divider"></li>
                                <!-- End Level two -->

                                <!-- Level three dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Proy. Urbanizaciones</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                        <li><a href="{{route('pu_por_rango_de_fechas_view')}}" class="dropdown-item"><i class="fas fa-calendar-alt"></i> Por: Rango de Fechas</a></li>
                                        <li><a href="{{route('pu_por_arquitectos_view')}}" class="dropdown-item"><i class="fas fa-user-check"></i> Por: Arquitectos</a></li>
                                        <li><a href="{{route('pu_por_categorias_view')}}" class="dropdown-item"><i class="fas fa-list-alt"></i> Por: Categorías</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-divider"></li>
                                <!-- End Level three -->
                                <li><a href="{{route('pagodeuda_rangofecha_view')}}" class="dropdown-item"><i class="fas fa-money-check"></i> Pago Deudas por Fechas</a></li>
                                <li><a href="{{route('ventaservicio_rangofecha_view')}}" class="dropdown-item"><i class="fas fa-shopping-cart"></i> Ventas por Fechas</a></li>
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('dropdown.configuraciones')
                         <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Configuraciones</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                <!-- == -->
                                @can('tipopago.index')
                                <li><a href="{{route('tipopagos.index')}}" class="dropdown-item"><i class="fas fa-user-cog"></i> Tipos de Pago</a></li>
                                @endcan
                                <!-- == -->
                                @can('tiposervicio.index')
                                <li><a href="{{route('tiposervicios.index')}}" class="dropdown-item"><i class="fas fa-user-cog"></i> Tipos de Servicios</a></li>
                                @endcan
                                <!-- == -->
                                {{-- @can('tiposervicio.index') --}}
                                <li><a href="{{route('gestiones.index')}}" class="dropdown-item"><i class="fas fa-calendar"></i> Gestiones</a></li>
                                {{-- @endcan --}}
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Consultas</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color: #BBDEBF">
                                <!-- == -->
                                <li><a href="{{route('consult_general')}}" class="dropdown-item"><i class="fas fa-folder-open"></i>Proyectos General Pendientes</a></li>
                                <!-- == -->
                                <li class="dropdown-divider"></li>
                                <li><a href="{{route('consult_urb')}}" class="dropdown-item"><i class="fas fa-folder-open"></i>Proyectos Urbanizaciones Pendientes</a></li>
                                <!-- == -->
                                <li class="dropdown-divider"></li>
                                <li><a href="{{route('deudas')}}" class="dropdown-item"><i class="fas fa-folder-open"></i>Deudas Pendientes</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrase') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hola, {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #BBDEBF">
                                    <a class="dropdown-item" href="{{ route('deudores_pdf') }}" target="_blank"><i class="fas fa-bell"></i> Deudores</a>
                                    <a class="dropdown-item" href="{{ route('perfilusuario.index') }}"><i class="fas fa-user-circle"></i> Perfil Usuario</a>
                                    
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