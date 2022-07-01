@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles del Usuario</div>
                <div class="card-body">
                    <p><strong>Usuario del Sistema: </strong>{{ $user->name }}</p>
                    <p><strong>Email: </strong>{{ $user->email }}</p>
                    <p><strong>Nombre: </strong>
                        @foreach($user->perfiles as $perfil)
                        {{$perfil->nombre}} {{$perfil->apaterno}} {{$perfil->amaterno}}
                        @endforeach
                    </p>
                    <p><strong>Carnet de Identidad: </strong>
                        @foreach($user->perfiles as $perfil)
                        {{$perfil->ci}} {{$perfil->expedicion->nombre}}
                        @endforeach
                    </p>
                    <p><strong>Telefono: </strong>
                        @foreach($user->perfiles as $perfil)
                        {{$perfil->telefono}}
                        @endforeach
                    </p>
                    <p><strong>Dirección: </strong>
                        @foreach($user->perfiles as $perfil)
                        {{$perfil->direccion}}
                        @endforeach
                    </p>
                    <button type="button" name="Back" onclick="history.back()" class="btn btn-outline-info"><i class="fas fa-history"></i> Volver a la Lista</button>
                </div>
            </div>
    </div>
</div>
@endsection