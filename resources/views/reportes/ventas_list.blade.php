<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N&deg;</th>
                <th>Fecha de registro</th>
                <th>Afiliado</th>
                <th>Detalles</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @forelse ($ventas as $item)
                <tr>
                    <td>{{ $cont }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                    <td>{{ $item->persona->full_name }}</td>
                    <td>
                        @php
                            $total = 0;
                        @endphp
                        <ul>
                            @foreach ($item->detalle as $detalle)
                            <li>{{ number_format($detalle->cantidad, 0) }} {{ $detalle->servicio->nombre }}</li>
                            @php
                                $total += ($detalle->precio * $detalle->cantidad) - $detalle->descuento;
                            @endphp
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($total, 2, ',', '.') }}</td>
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