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
                    <th>Afiliado</th>
                    <th>Detalles</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                    $total = 0;
                @endphp
                @forelse ($ventas as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                        <td>{{ $item->persona->full_name }}</td>
                        <td>
                            @php
                                $subtotal = 0;
                            @endphp
                            <ul>
                                @foreach ($item->detalle as $detalle)
                                <li>{{ number_format($detalle->cantidad, 0) }} {{ $detalle->servicio->nombre }}</li>
                                @php
                                    $subtotal += ($detalle->precio * $detalle->cantidad) - $detalle->descuento;
                                @endphp
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-right">{{ number_format($subtotal, 2, ',', '.') }}</td>
                    </tr>
                    @php
                        $cont++;
                        $total += $subtotal;
                    @endphp
                @empty
                    <tr>
                        <td colspan="5"><h5 class="text-muted text-center">No hay resultados</h5></td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td class="text-right"><b>{{ number_format($total, 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>