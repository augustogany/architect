@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Inicio S!sC@B - Principal</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenid@s!
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

                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Tabla Informativa</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item active">
                            <a href="{{route('personas.index')}}" class="nav-link">
                              <i class="fas fa-users"></i> Arquitectos.
                              <span class="badge bg-primary float-right">{{$personas}}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('proyectogeneral.index')}}" class="nav-link">
                              <i class="fas fa-home"></i> Viviendas.
                              <span class="badge bg-primary float-right">{{$count_viviendas}}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('proyectogeneral.index')}}" class="nav-link">
                              <i class="far fa-building"></i> Comercio y Oficinas.
                              <span class="badge bg-primary float-right">{{$count_oficinas}}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('proyectourbanizacion.index')}}" class="nav-link">
                              <i class="fas fa-map-marked-alt"></i> Urbanizaciones.
                              <span class="badge bg-primary float-right">{{$count_urbanizacion}}</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <!-- /.card-body -->
                    </div>
                 
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

