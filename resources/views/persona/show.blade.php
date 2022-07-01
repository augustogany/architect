@extends('layouts.app')
@section('title','Viendo persona')

@section('content')
    <form action="{{route('personas.update',$persona->id)}}" method="POST">
        @csrf @method('PATCH')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Viendo persona
                        </div>
                        <div class="card-body">
                            <div class="row">

                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- @include('persona.partials.actions') --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection







