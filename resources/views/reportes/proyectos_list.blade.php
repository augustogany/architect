<div class="col-md-12 text-right">
    <button type="button" onclick="report_export('pdf')" class="btn btn-danger btn-sm">PDF</button>
</div>
<br>
<div class="col-md-12">
    <div class="table-responsive">
        @if ($tipo == 'general')
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Fecha de registro</th>
                        <th>Afiliado</th>
                        <th>Proyecto</th>
                        <th>Categoría</th>
                        <th>Precio Unit.</th>
                        <th>Superficie</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                        $total = 0;
                    @endphp
                    @forelse ($proyectos as $item)
                        <tr>
                            <td>{{ $cont }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                            <td>{{ $item->persona->full_name }}</td>
                            <td>{{ $item->proyecto }}</td>
                            <td>{{ $item->categoriageneral->nombre }}</td>
                            <td>{{ $item->costocategoria }}</td>
                            <td>{{ $item->superficiemts2 }}</td>
                            <td class="text-right">{{ $item->totalbs }}</td>
                        </tr>
                        @php
                            $cont++;
                            $total += $item->totalbs;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="8"><h5 class="text-muted text-center">No hay resultados</h5></td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="7"><b>TOTAL</b></td>
                        <td class="text-right"><b>{{ number_format($total, 2, ',', '.') }}</b></td>
                    </tr>
                </tbody>
            </table>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Afiliado</th>
                        <th>Proyecto</th>
                        <th>Precio Unit.</th>
                        <th>Superficie</th>
                        <th>Total</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @forelse ($proyectos as $item)
                        <tr>
                            <td>{{ $cont }}</td>
                            <td>{{ $item->persona->full_name }}</td>
                            <td>{{ $item->proyecto }}</td>
                            <td>{{ number_format($item->costo_pu_categoria, 2, ',', '.') }}</td>
                            <td>{{ $item->superficiemts2 }}</td>
                            <td>{{ number_format($item->totalbs, 2, ',', '.') }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                        </tr>
                        @php
                            $cont++;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="7"><h5 class="text-muted text-center">No hay resultados</h5></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
</div>