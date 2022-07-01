@extends('layouts.app')
@section('title','Crear Nuevo Tipo de Servicio')

@section('content')

<form action="{{route('tiposervicios.store')}}" method="POST">
@csrf
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card" style="background-color: #8FBC8F">
				<div class="card-header">
                    <i class="fas fa-pencil-alt"></i>
					Registrar Tipo de Servicio.
				</div>

				<div class="card-body" style="background-color: #F0F8FF">
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="nombre" class="form-control form-control-sm" placeholder="Nombre tipo de Servicio." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre Tipo de Servicio.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" required name="precio" step="0.01" class="form-control form-control-sm"  placeholder="PRECIO.">
                                </div>
                                <small>Precio Servicio.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
                    @include('configuracion.tiposervicio.partials.actions')
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection







