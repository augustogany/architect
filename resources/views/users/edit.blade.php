
@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('users.update', $user->id)}}">
    @csrf @method('PATCH')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar Roles del Usuario</div>
                <div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required id="name" name="name" value="{{$user->name}}" placeholder="Nombre de Usuario" autocomplete="off">
                                </div>
                                <small>Nombre de Usuario.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
                    <hr>
                    <h3>Lista de roles</h3>
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                @foreach($roles as $id => $name)
                                    <div class="checkbox">
                                        <label>
                                            <input name="roles[]" type="checkbox" value="{{$id}}" {{$user->roles->contains($id) ? 'checked':''}}>
                                            {{$name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- === -->
                    </div>

                </div>
                <div class="card-footer">
                    @include('users.partials.actions')
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
