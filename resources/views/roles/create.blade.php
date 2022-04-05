@extends('layouts.app')

@section('content')
<form action="{{route('roles.store')}}" method="POST">
    @csrf
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Nuevo Rol</div>
                <div class="card-body">
                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="name" value="{{old('name')}}" placeholder="Nombre del Rol." autocomplete="off">
                                </div>
                                <small>Nombre del Rol.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="slug" value="{{old('slug')}}" placeholder="Nombre del Slug." autocomplete="off">
                                </div>
                                <small>Nombre del Slug.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="description" value="{{old('description')}}" placeholder="Descripción del Rol." autocomplete="off">
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
                                            <input name="permissions[]" value="{{$id}}" type="checkbox">
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