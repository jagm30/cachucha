
<table>
    <thead>
    <tr>
        <th colspan="3"><div>
           <!-- <img src="{{ public_path().'/images/logo.png' }}" width="100" height="70">-->
        </div></th>
        <th></th>
        <th></th>        
    </tr>    
    <tr>
        <th width="40"><b>CODIGO DE BARRAS</b></th>
        <th width="100"><b>PRODUCTO</b></th>
        <th><b>COSTO UNITARIO</b></th>
        <th><b>COSTO MAYOREO</b></th>
        <th><b>STOCK</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($inventarios as $row)
        <tr>
            <td>{{$row->codigo_barras}}</td>
            <td>{{ $row->nombre_producto }}</td>
            <td>$ {{ number_format($row->costo_unitario,2) }}</td>
            <td>$ {{ number_format($row->precio_mayoreo,2) }}</td>
            <td><B>{{ $row->cantidad }}</B></td>
        </tr>
    @endforeach
    </tbody>
</table>