@extends('layouts.app')
@section('title','Perfil Usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
              	<div class="card-body box-profile">
					@if($perfil)
						<div class="text-center">
							@php
								$image = 'theme/dist/img/user-account.png';
								if($perfil->imagen){
									$image = asset('storage/'.str_replace('.', '_small.', $perfil->imagen));
								}
							@endphp
							<img class="profile-user-img img-fluid img-circle" src="{{ $image }}">
						</div>
		                <h3 class="profile-username text-center">{{$perfil->nombre}} {{$perfil->apaterno}} {{$perfil->amaterno}}</h3>
		                <p class="text-muted text-center">Nombre Usuario: {{$perfil->user->name}}</p>

		                <ul class="list-group list-group-unbordered mb-3">
		                  	<li class="list-group-item">
		                    	<b>Carnet identidad:</b> {{$perfil->ci}} {{$perfil->expedicion->nombre}}
		                  	</li>
		                  	<li class="list-group-item">
		                    	<b>Teléfono:</b> {{$perfil->telefono}}
		                  	</li>
		                  	<li class="list-group-item">
		                    	<b>Dirección:</b> {{$perfil->direccion}}
		                  	</li>
		                  	<li class="list-group-item">
		                    	<b>Correo Electrónico:</b> {{$perfil->user->email}}
		                  	</li>
		                </ul>

		                <a href="{{route('perfilusuario.create')}}" class="btn btn-primary btn-block"><b>Actualizar datos del usuario</b></a>
		                {{-- <a href="{{route('documentacion')}}" class="btn btn-primary btn-block"><b>Kardex personal</b></a> --}}
		            @else
                    	<p style="text-align: center;">No hay datos del usuario !{{ Auth::user()->name }}! para mostrar</p>
                      	<a href="{{route('perfilusuario.create')}}" class="btn btn-primary btn-block"><b>Registrar datos del usuario</b></a>
                    @endif

	            </div>
            </div>
        </div>
    </div>
</div>
@endsection