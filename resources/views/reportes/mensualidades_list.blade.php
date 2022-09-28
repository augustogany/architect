<div class="col-md-12 text-right">
    <button type="button" onclick="report_export('pdf')" class="btn btn-danger btn-sm">PDF</button>
</div>
<br>

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>Fecha de registro</th>
                    <th>Cantidad de mensualidades</th>
                    <th>Descuento</th>
                    <th>Monto pagado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                @endphp
                @forelse ($pagos as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->fecha_pago)) }}</td>
                        <td>
                            <ul>
                                @foreach ($item->mensualidades as $mensualidad)
                                <li>{{ $mensualidad->mes }}/{{ $mensualidad->gestion->gestion }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $item->descuento }}</td>
                        <td>{{ $item->mensualidades->sum('monto_pagado') - $item->descuento }}</td>
                    </tr>
                    @php
                        $cont++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="5"><h5 class="text-muted text-center">No hay resultados</h5></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>