@extends('layouts.app')
@section('title','Editar Persona')

@section('content')
<form action="{{route('personas.update',$persona->id)}}" method="POST">
    @csrf @method('PATCH')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Editar Persona
				</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="nombre" value="{{$persona->nombre}}" required placeholder="Nombres." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre(s)</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="apaterno" value="{{$persona->apaterno}}" required placeholder="Apellido Paterno." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Apellido Paterno</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="amaterno" value="{{$persona->amaterno}}" required placeholder="Apellido Materno." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Apellido Materno</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" name="numeroregistro" value="{{$persona->numeroregistro}}" required placeholder="NUMERO DE REGISTRO." autocomplete="off">
                                </div>
                                <small>Número de Registro</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" name="ci" value="{{$persona->ci}}" placeholder="CI" autocomplete="off">
                                </div>
                                <small>Cédula de Identidad</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" name="telefono" value="{{$persona->telefono}}" placeholder="TELEFONO" autocomplete="off">
                                </div>
                                <small>Teléfono</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" class="form-control form-control-sm" name="correo" value="{{$persona->correo}}" placeholder="Correo Electrónico." autocomplete="off">
                                </div>
                                <small>Correo Electrónico</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control form-control-sm" name="fecha_afiliacion" value="{{$persona->fecha_afiliacion}}" required>
                                </div>
                                <small>Fecha de afiliación</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="month" class="form-control form-control-sm" name="ultimo_pago" value="{{ $persona->ultimo_pago }}" @if($persona->ultimo_pago && Auth::user()->roles[0]->id != 1) readonly @endif required>
                                </div>
                                <small>Último mes pagado</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control form-control-sm" name="direccion" placeholder="Direccion." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" rows="3">{{ $persona->direccion }}</textarea>
                                </div>
                                <small>Dirección.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <!-- === -->
                        <div class="col-sm-12" align="center">
                            <label for="">Datos de Inicio de Session</label>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" 
                                           class="form-control form-control-sm" 
                                           name="email" 
                                           placeholder="ejemplo@cadbeni.com" 
                                           autocomplete="off"
                                           value="{{$user->email ?? ''}}"
                                    >
                                </div>
                                <small>Nombre de Usuario</small>
                            </div>
                        </div>
                        <!-- === -->
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control form-control-sm" name="password" placeholder="password" autocomplete="off">
                                </div>
                                <small>Password</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer text-right">
                    <a href="{{route('personas.index')}}" class="btn btn-outline-dark"><i class="fas fa-times"></i> Cancelar</a>
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Guardar</button>
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection







