@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">CAD-BENI</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido!
                    <hr>
                    
                  {{--   <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- -- -->
                        <div class="col-lg-3 col-6">
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{{$personas}}</h3>

                              <p>Arquitectos</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('personas.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- -- -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                              <div class="inner">
                                <h3>{{$count_viviendas}}</h3>

                                <p>Viviendas</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-home"></i>
                              </div>
                              <a href="{{route('proyectogeneral.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- -- -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                              <div class="inner">
                                <h3>{{$count_oficinas}}</h3>

                                <p>Comercio y Oficinas</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-home"></i>
                              </div>
                              <a href="{{route('proyectogeneral.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- -- -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                              <div class="inner">
                                <h3>{{$count_urbanizacion}}</h3>

                                <p>Urbanizaciones</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-location"></i>
                              </div>
                              <a href="{{route('proyectourbanizacion.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row --> --}}

                    @if (Auth::user()->roles->where('id', 5)->count() > 0)
                        
                    @else
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Tabla Informativa</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        @php
                          $sucursales = Auth::user()->sucursales;
                          foreach ($sucursales as $key => $value) {
                            $id_sucursales[] = $value->id;
                          }

                          $personas = App\Persona::count();

                          $count_viviendas = App\Proyectogeneral::where('categoriageneral_id','=','1')
                              ->whereIn('sucursal_id',$id_sucursales)
                              ->count();

                          $count_oficinas = App\Proyectogeneral::where('categoriageneral_id','=','3')
                              ->whereIn('sucursal_id',$id_sucursales)
                              ->count();

                          $count_urbanizacion = App\Proyectourbanizacion::where('condicion','=','1')
                              ->whereIn('sucursal_id',$id_sucursales)
                              ->count();
                        @endphp 
                        <div class="card-body p-0">
                          <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                              <a href="{{route('personas.index')}}" class="nav-link">
                                <i class="fas fa-users"></i> Arquitectos
                                <span class="badge bg-primary float-right">{{$personas}}</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('proyectogeneral.index')}}" class="nav-link">
                                <i class="fas fa-home"></i> Viviendas
                                <span class="badge bg-primary float-right">{{$count_viviendas}}</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('proyectogeneral.index')}}" class="nav-link">
                                <i class="far fa-building"></i> Comercio y Oficinas
                                <span class="badge bg-primary float-right">{{$count_oficinas}}</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('proyectourbanizacion.index')}}" class="nav-link">
                                <i class="fas fa-map-marked-alt"></i> Urbanizaciones
                                <span class="badge bg-primary float-right">{{$count_urbanizacion}}</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    @endif
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

