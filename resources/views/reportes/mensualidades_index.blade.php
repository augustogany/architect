@extends('layouts.app')
@section('title','Pago de mensualidades')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i>
                        Pago de mensualidades
                        <div class="card-tools">
                        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <form id="form" action="{{ route('reportes.mensualidades.list') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        {{-- <div class="form-group col-md-12">
                                            <select name="gestion_id" class="form-control form-control-sm">
                                                <option value="">Todas las gestiones</option>
                                                @foreach (App\Gestion::orderBy('gestion', 'desc')->get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->gestion }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group col-md-12">
                                            <select name="persona_id" class="form-control form-control-sm"  required>
                                                <option value="">Seleccione afiliado</option>
                                                @foreach (App\Persona::orderBy('nombre')->get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button class="btn btn-sm btn-primary">Generar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div id="lista"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right d-none d-sm-block">
                            <b>Version</b> 1.2
                        </div>
                        <strong>Copyright &copy; 2022 <a href="#">C@DBENI</a>.</strong> Todos los derechos reservados.
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push ('styles')
    
@endpush

@push ('script')
    <script>
        $(document).ready(function() {
            $('#form').submit(function(e){
                e.preventDefault();
                $.post($(this).attr('action'), $(this).serialize(), function(res){
                    $('#lista').html(res);
                });
            });
        });
    </script>
@endpush


