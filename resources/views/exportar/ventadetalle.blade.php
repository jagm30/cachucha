
<table>
    <thead>
    <tr>
        <th colspan="3"><div>
            <img src="{{ public_path().'/images/logo.png' }}" width="100" height="70">
        </div></th>
        <th></th>
        <th></th>
        <th></th>        
    </tr>    
    <tr>
        <th width="20"><b>Fecha</b></th>
        <th width="20"><b>Tipo de venta</b></th>
        <th width="20"><b>No. de ticket</b></th>
        <th><b>Forma de pago</b></th>
        <th><b>Importe</b></th>
        <th><b>Status</b></th>  
        <th><b>Detalle articulos</b></th>
        <th><b>Detalle p. unitario</b></th>
        <th><b>Detalle p. descuento</b></th>
        <th><b>Detalle cantidad</b></th>
        <th><b>Detalle importe</b></th>
    </tr>
    </thead>
    <tbody>
    {{$total = 0}}
    @foreach($ventas as $row)
        <tr style="background-color: #ffe; color:gray;">
            <td>{{ $row->fecha }}</td>
            <td>{{$row->tipo_venta}}</td>
            <td>{{$row->folio}}</td>
            <td>{{$row->forma_pago}}</td>
            <td align="right">$ {{number_format($row->subtotal, 2)}} </td>
            <td>{{$row->status}}</td>
        </tr>
        {{$total = $total + $row->subtotal}}
        @foreach($ventaarticulos as $articulos)
            
            @if($row->id == $articulos->id_venta)
                <tr>
                    <td>{{$row->fecha}}</td>
                    <td>{{$row->tipo_venta}}</td>
                    <td>{{$row->folio}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$articulos->nombre_producto}}</td>
                    <td>{{$articulos->costo_unitario}}</td>
                    <td>{{$articulos->precio_descuento}}</td>
                    <td align="right">{{$articulos->cantidad}}</td>
                    <td align="right">{{$articulos->importe}}</td>
                </tr>
            @endif
        @endforeach
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