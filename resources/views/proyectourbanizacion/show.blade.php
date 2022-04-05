@extends('layouts.app')
@section('title','Detalle Proyecto Generales')

<style>
    table th {
      text-align: center;
    }

    table td {
      text-align: center;
    }
</style>

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i>
                    Proyectos: Urbanización / Detalle de Proyecto
                    <div class="card-tools">
                      <a href="{{ route('proyectourbanizacion.index') }}" class="btn btn-outline-success btn-lg" title="Crear Nuevo Proyecto"><i class="fas fa-history"></i></a>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered"  style="font-size: 10pt">
                      <tr>
                        <th>Mts2 Inicio:</th>
                        <td>{{$proyectourbanizacions->categoriaurbanizacion->mt2_inicio}}</td>
                        <th>Mts2 Fin:</th>
                        <td>{{$proyectourbanizacions->categoriaurbanizacion->mt2_fin}}</td>
                      </tr>
                      <tr>
                        <th>Arancel:</th>
                        <td>{{$proyectourbanizacions->arancelcategoria}}</td>
                        <th>Costo Precio Unitario:</th>
                        <td>{{$proyectourbanizacions->costo_pu_categoria}}</td>
                      </tr>
                      <tr>
                        <th>Porcentaje CADBENI:</th>
                        <td>{{$proyectourbanizacions->porcentaje_cab_categoria}}</td>
                        <th>Visado $U.S.:</th>
                        <td>{{$proyectourbanizacions->visado_sus_categoria}}</td>
                      </tr>
                      <tr>
                        <th>Visado Bs.:</th>
                        <td><span class="badge bg-danger">{{$proyectourbanizacions->visado_bs_categoria}} Bs.</span></td>
                        <th>Superficie Proyecto:</th>
                        <td>{{$proyectourbanizacions->superficiemts2}}</td>
                      </tr>
                      <tr>
                        <th>Proyecto:</th>
                        <td colspan="3">{{$proyectourbanizacions->proyecto}}</td>
                      </tr>
                      <tr>
                        <th>Propietarios:</th>
                        <td colspan="3">{{$proyectourbanizacions->propietario}}</td>
                      </tr>
                      <tr>
                        <th>Descuento del Proyecto:</th>
                        <td><span class="badge bg-danger">{{$proyectourbanizacions->descuento}} Bs.</span></td>
                        <th>Total a Pagar:</th>
                        <td><span class="badge bg-success">{{$proyectourbanizacions->totalbs}} Bs.</span></td>
                      </tr>
                      <tr>
                        <th>Arquitecto CADBENI:</th>
                        <td colspan="3">{{$proyectourbanizacions->persona->nombre}} {{$proyectourbanizacions->persona->apaterno}} {{$proyectourbanizacions->persona->amaterno}} - {{$proyectourbanizacions->persona->numeroregistro}}</td>
                      </tr>
                  </table>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection