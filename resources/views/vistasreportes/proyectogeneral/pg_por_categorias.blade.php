@extends('layouts.app')
@section('title','Reporte: Proyectos por Categorías')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="loader">

            </div>
            <form action="{{route('pg_por_categorias_report')}}" method="POST">
              @csrf
                <div class="card" style="background-color: #8FBC8F">
                  <div class="card-header">
                      Proyectos Generales por Categorías
                  </div>
                  <div class="card-body" style="background-color: #F0F8FF">
                    <div class="row">
                      <!-- === -->
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="form-line">
                          	<select required name="sucursal_id" class="form-control form-control-sm">
                                @foreach ($sucursales as $sucursal)
                                  <option value="{{$sucursal->id}}">{{$sucursal->sucursal}}</option>
                                @endforeach
                            </select>
                          </div>
                          <small>Sucursal (Usuario del Sistema).</small>
                        </div>
                      </div>
                      <!-- === -->
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="form-line">
                            <select required name="categoriageneral_id" class="form-control form-control-sm select2">
                                @foreach ($categoriagenerals as $categoriageneral)
                                  <option value="{{$categoriageneral->id}}">{{$categoriageneral->nombre}}</option>
                                @endforeach
                            </select>
                          </div>
                          <small>Categorías Generales.</small>
                        </div>
                      </div>
                      <!-- === -->
                      <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" required class="form-control form-control-sm" value="{{old('fechainicio')}}" name="fechainicio">
                                </div>
                                <small>Fecha Inicio.</small> <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red;" title="Campo requerido"></i>
                            </div>
                        </div>
                      <!-- === -->
                      <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" required class="form-control form-control-sm" value="{{old('fechafin')}}" name="fechafin">
                                </div>
                                <small>Fecha Final.</small> <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red;" title="Campo requerido"></i>
                            </div>
                        </div>
                      <!-- === -->
                    </div>
                  </div>
                  <div class="card-footer">
                    @include('vistasreportes.partials.actions')
                  </div>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@push ('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('theme/plugins/select2/css/select2.min.css')}}">
@endpush

@push ('script')
    <!-- Select2 -->
    <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2();
    </script>
@endpush



