@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">CAD-BENI</div>

            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
              @endif

              @if (Auth::user()->roles->where('id', 5)->count() > 0)

                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Perfil de usuario</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pagos de mensualidades</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Proyectos</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    @php
                      $perfil = App\Perfil::where('user_id', Auth::user()->id)->first();
                      if(!$perfil){
                        $perfil = App\Perfil::create([
                          'user_id' => Auth::user()->id,
                          'nombre_completo' => Auth::user()->persona->nombre.' '.Auth::user()->persona->apaterno.' '.Auth::user()->persona->amaterno,
                          'telefono' => Auth::user()->persona->telefono,
                          'direccion' => Auth::user()->persona->direccion
                        ]);
                      }

                      $image = 'theme/dist/img/user-account.png';
                      if($perfil->imagen){
                        $image = asset('storage/'.str_replace('.', '_small.', $perfil->imagen));
                      }
                    @endphp

                    <div class="container rounded bg-white mb-2">
                      <form id="form" action="{{ route('perfilusuario.update', $perfil->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                          <div class="col-md-3 border-right">
                              <div class="d-flex flex-column align-items-center text-center p-3">
                                <img class="rounded-circle" width="150px" src="{{ $image }}">
                                <span class="font-weight-bold">{{ $perfil->nombre_completo }}</span>
                                <span class="text-black-50">{{ $perfil->email }}</span>
                                @php
                                    $ultimo_pago = $perfil->user->persona->ultimo_pago;
                                    if($ultimo_pago){
                                      $ultimo_pago = Carbon\Carbon::parse($ultimo_pago)->floorMonth();
                                      $fecha_actual = Carbon\Carbon::now()->floorMonth();
                                      $anios = intval($ultimo_pago->diffInMonths($fecha_actual) / 12);
                                      $meses = $ultimo_pago->diffInMonths($fecha_actual) % 12;
                                    }
                                @endphp

                                {!! (date('Ym', strtotime($ultimo_pago)) < date('Ym') ? '<span class="badge badge-danger"> Debe '.($anios ? $anios.' año(s)' : '').($anios && $meses ? ' y ' : ' ').($meses ? $meses.' meses' : '').'</span>' : '<span class="badge badge-success">Sin deuda</span>') !!}
                              </div>
                          </div>
                          <div class="col-md-5 border-right">
                              <div class="p-3">
                                  <div class="d-flex justify-content-between align-items-center">
                                      <h5 class="text-right text-muted">Datos personales</h5>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12 mt-3">
                                        <label class="labels">Nombre completo</label>
                                        <input type="text" name="nombre_completo" class="form-control" value="{{ $perfil->nombre_completo }}" required>
                                      </div>
                                      <div class="col-md-6 mt-3">
                                        <label class="labels">Telefono</label>
                                        <input type="text" name="telefono" class="form-control" value="{{ $perfil->telefono }}">
                                      </div>
                                      <div class="col-md-6 mt-3">
                                        <label class="labels">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $perfil->email }}">
                                      </div>
                                      <div class="col-md-12 mt-3">
                                        <label class="labels">Foto de perfil</label>
                                        <input type="file" name="imagen" class="form-control" accept="image/*">
                                      </div>
                                      <div class="col-md-12 mt-3">
                                        <label class="labels">Dirección</label>
                                        <textarea name="direccion" class="form-control">{{ $perfil->direccion }}</textarea>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="p-3">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-right text-muted">Datos profesionales</h5>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-10 mt-3">
                                      <label class="labels">Hoja de vida</label>
                                      <input type="file" name="cv" class="form-control" accept="application/pdf">
                                    </div>
                                    <div class="col-md-2 mt-3" style="padding-top: 40px">
                                      @if ($perfil->cv)
                                        <a href="{{ url('storage/'.$perfil->cv) }}" target="_blank">Ver</a>
                                      @endif
                                    </div>
                                  </div>
                              </div>

                              <div class="p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                  <h5 class="text-right text-muted">Datos de usuario</h5>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 mt-3">
                                    <label class="labels">Contraseña</label>
                                    <input type="password" name="password" class="form-control" value="">
                                    <small>Se cambiara solo si ingresas una nueva</small>
                                  </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mt-3 text-right">
                              <button type="submit" class="btn btn-primary profile-button" type="button">Actualizar datos</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @php
                        $pagos = App\PersonasPago::where('persona_id', $perfil->user->persona_id)->where('deleted_at', NULL)->get();
                    @endphp
                    <div class="table-responsive" style="margin-top: 20px">
                      <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>N&deg; de recibo</th>
                                {{-- <th>Sucursal</th> --}}
                                <th>Fecha</th>
                                <th>Cantidad cuotas</th>
                                <th>Subtotal</th>
                                <th>Descuento</th>
                                <th>Total</th>
                                {{-- <th>Observaciones</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pagos as $item)
                                <tr>
                                    <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                    {{-- <td>{{ $item->sucursal->sucursal }}</td> --}}
                                    <td>{{ date('d/M/Y', strtotime($item->fecha_pago)) }}</td>
                                    <td>
                                      @php
                                          $mes = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                                          $detalles = '';
                                          if($item->mensualidades->count() == 1){
                                              $detalles = 'cuota ('.$mes[$item->mensualidades->first()->mes].' de '.$item->mensualidades->last()->gestion->gestion.')';
                                          }elseif($item->mensualidades->count() == 2){
                                              $detalles = 'cuotas ('.$mes[$item->mensualidades->first()->mes].' y '.$mes[$item->mensualidades->last()->mes].' de '.$item->mensualidades->last()->gestion->gestion.')';
                                          }else{
                                              $detalles = 'cuotas ('.$mes[$item->mensualidades->first()->mes].' a '.$mes[$item->mensualidades->last()->mes].' de '.$item->mensualidades->last()->gestion->gestion.')';
                                          }
                                      @endphp
                                      Pago de {{ $item->mensualidades->count() }} <br> {{ $detalles }}
                                    </td>
                                    <td>{{ number_format($item->mensualidades->sum('monto_pagado'), 2, ',', '.') }}</td>
                                    <td>{{ number_format($item->descuento, 2, ',', '.') }}</td>
                                    <td>{{ number_format($item->mensualidades->sum('monto_pagado') - $item->descuento, 2, ',', '.') }}</td>
                                    {{-- <td>{{ $item->observacion }}</td> --}}
                                    {{-- <td>
                                        <a href="{{ route('personas.pagomensualidad.print', $item->id) }}" target="_blank" title="Imprimir" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i></a>
                                    </td> --}}
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                </div>
                  
              @else
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tabla Informativa</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  @php
                    $sucursales = Auth::user()->sucursales;
                    foreach ($sucursales as $key => $value) {
                      $id_sucursales[] = $value->id;
                    }

                    $personas = App\Persona::count();

                    $count_viviendas = App\Proyectogeneral::where('categoriageneral_id','=','1')
                        ->whereIn('sucursal_id',$id_sucursales)
                        ->count();

                    $count_oficinas = App\Proyectogeneral::where('categoriageneral_id','=','3')
                        ->whereIn('sucursal_id',$id_sucursales)
                        ->count();

                    $count_urbanizacion = App\Proyectourbanizacion::where('condicion','=','1')
                        ->whereIn('sucursal_id',$id_sucursales)
                        ->count();
                  @endphp 
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item active">
                        <a href="{{route('personas.index')}}" class="nav-link">
                          <i class="fas fa-users"></i> Arquitectos
                          <span class="badge bg-primary float-right">{{$personas}}</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('proyectogeneral.index')}}" class="nav-link">
                          <i class="fas fa-home"></i> Viviendas
                          <span class="badge bg-primary float-right">{{$count_viviendas}}</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('proyectogeneral.index')}}" class="nav-link">
                          <i class="far fa-building"></i> Comercio y Oficinas
                          <span class="badge bg-primary float-right">{{$count_oficinas}}</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('proyectourbanizacion.index')}}" class="nav-link">
                          <i class="fas fa-map-marked-alt"></i> Urbanizaciones
                          <span class="badge bg-primary float-right">{{$count_urbanizacion}}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
              @endif
            </div>

          </div>
        </div>
    </div>
</div>
@endsection

@push ('styles')
  <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('script')
  <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script>
    $('#dataTable').DataTable({"order":[[0, 'desc']],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});
  </script>
@endpush
