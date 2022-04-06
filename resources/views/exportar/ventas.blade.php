
<table>
    <thead>
    <tr>
        <th colspan="3"><div>
            <img src="{{ public_path().'/images/logo.png' }}" width="100" height="70">
        </div></th>
        <th></th>
        <th></th>        
    </tr>    
    <tr>
        <th width="20"><b>Fecha</b></th>
        <th width="40"><b>Tipo de venta</b></th>
        <th width="20"><b>No. de ticket</b></th>
        <th><b>Forma de pago</b></th>
        <th><b>Importe</b></th>        
    </tr>
    </thead>
    <tbody>
    	{{$total = 0}}    
    @foreach($abonos as $row2)
        <tr>
            <td>{{ $row2->fecha }}</td>
            <td>{{ $row2->tipo_venta }}</td>
            <td>{{$row2->folio}}</td>
            <td>{{$row2->forma_pago}}</td>
            <td align="right">${{number_format($row2->cantidad_abonada, 2)}} </td>
        </tr>
        {{$total = $total + $row2->cantidad_abonada}}
    @endforeach
    	<tr>
    		<td></td>
    		<td></td>
            <td></td>
    		<td align="right">Total</td>
    		<td align="right">${{number_format($total,2)}}</td>
    	</tr>
    </tbody>
</table>