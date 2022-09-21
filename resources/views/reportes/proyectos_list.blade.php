<div class="table-responsive">
    @if ($tipo == 'general')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>Afiliado</th>
                    <th>Proyecto</th>
                    <th>Categoría</th>
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
                        <td>{{ $item->categoriageneral->nombre }}</td>
                        <td>{{ $item->costocategoria }}</td>
                        <td>{{ $item->superficiemts2 }}</td>
                        <td>{{ $item->totalbs }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                    </tr>
                    @php
                        $cont++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="8"><h5 class="text-muted text-center">No hay resultados</h5></td>
                    </tr>
                @endforelse
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