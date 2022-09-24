@extends('layouts.app')
@section('title','Editar tipo de trámite')

@section('content')

<form id="form" action="{{route('tiposervicios.update',$tiposervicio->id)}}" method="POST">
@csrf @method('PATCH')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit"></i>
                    Editar tipo de trámite
                </div>

                <div class="card-body">
                    @if(Session::has('notice'))
                    <div class="alert alert-danger">
                      <ul>
                        <li>
                           <p>{{ Session::get('notice')}}</p>
                        </li>
                      </ul>
                    </div>
                    @endif

                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="nombre" value="{{$tiposervicio->nombre}}" class="form-control form-control-sm" placeholder="Nombre tipo de Servicio." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre Tipo de Servicio.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" required name="precio" value="{{$tiposervicio->precio}}" step="0.01" class="form-control form-control-sm"  placeholder="PRECIO.">
                                </div>
                                <small>Precio Servicio.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
                </div>
                <div class="card-footer">
                    @include('configuracion.tiposervicio.partials.actions_update')
                </div>

            </div>
        </div>
    </div>
</div>
</form>
@endsection







