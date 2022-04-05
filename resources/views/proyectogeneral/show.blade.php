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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i>
                    Proyectos: Viviendas - Comercio y Oficinas / Detalle de Proyecto
                    <div class="card-tools">
                      <a href="{{ route('proyectogeneral.index') }}" class="btn btn-outline-success btn-lg" title="Crear Nuevo Proyecto"><i class="fas fa-history"></i></a>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered"  style="font-size: 10pt">
                      <tr>
                        <th colspan="2">{{$proyectogeneral->proyecto}}</th>
                      </tr>
                      <tr>
                        <th>Categoría:</th>
                        <td colspan="2">{{$proyectogeneral->categoriageneral->nombre}}</td>
                      </tr>
                      <tr>
                        <th>Costo Categoría:</th>
                        <td colspan="2">{{$proyectogeneral->categoriageneral->costo}}</td>
                      </tr>
                      <tr>
                        <th>Superficie Mt2:</th>
                        <td colspan="2">{{$proyectogeneral->superficiemts2}} Mts2</td>
                      </tr>
                      <tr>
                        <th>Costo Parcial del Proyecto:</th>
                        <td colspan="2"><span class="badge bg-danger">{{$proyectogeneral->totalbs_inicial}} Bs.</span></td>
                      </tr>
                      <tr>
                        <th>Descuento del Proyecto:</th>
                        <td colspan="2"><span class="badge bg-danger">{{$proyectogeneral->descuento}} Bs.</span></td>

                      </tr>
                      <tr>
                        <th>Total a Pagar:</th>
                        <td colspan="2"><span class="badge bg-success">{{ number_format($proyectogeneral->total,2,'.','')}} Bs.</span></td>
                      </tr>
                      <tr>
                        <th>Estado:</th>
                        <td colspan="2">
                            <span 
                              class="badge {{$proyectogeneral->estado == 'finalizado' ? 'bg-success' : 'bg-danger'}}"
                            >
                                  {{$proyectogeneral->estado}}
                            </span></td>
                      </tr>
                      <tr>
                        <th colspan="2">Propietaio (s)</th>
                      </tr>
                      <tr>
                        <td colspan="2">{{$proyectogeneral->propietario}}</td>
                      </tr>
                      <tr>
                        <th colspan="2">Arquitecto</th>
                      </tr>
                      <tr>
                        <td colspan="2">{{$proyectogeneral->persona->nombre}} {{$proyectogeneral->persona->aparteno}} {{$proyectogeneral->persona->amaterno}} - {{$proyectogeneral->persona->numeroregistro}}</td>
                      </tr>
                      <tr>
                        <th>Fecha Registro del Proyecto:</th>
                        <td colspan="2">{{$proyectogeneral->fecharegistro}}</td>
                      </tr>
                  </table>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection