@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('roles.update', $role->id)}}">
    @csrf @method('PATCH')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar el Rol Seleccionado</div>
                <div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="name" value="{{$role->name}}" placeholder="Nombre del Rol." autocomplete="off">
                                </div>
                                <small>Nombre del Rol.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="slug" value="{{$role->slug}}" placeholder="Nombre del Slug." autocomplete="off">
                                </div>
                                <small>Nombre del Slug.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="description" value="{{$role->description}}" placeholder="Descripción del Rol." autocomplete="off">
                                </div>
                                <small>Descripción del Rol.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
                    <hr>
                    <h3>Lista de Permisos</h3>
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                @foreach($permissions as $id => $name)
                                    <div class="checkbox">
                                        <label>
                                            <input name="permissions[]" type="checkbox" value="{{$id}}" {{$role->permissions->contains($id) ? 'checked':''}}>
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
                    @include('roles.partials.actions')
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection