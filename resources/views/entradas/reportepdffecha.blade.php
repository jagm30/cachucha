<!DOCTYPE html>
<html lang="es">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Reporte de Entrada de productos</title>
<style>
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  /*background: url(dimension.png);*/
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
      /** 
      * Set the margins of the PDF to 0
      * so the background image will cover the entire page.
      **/
      @page {
          margin: 0cm 0cm;
      }

      /**
      * Define the real margins of the content of your PDF
      * Here you will fix the margins of the header and footer
      * Of your background image.
      **/
      body {
          margin-top:    3cm;
          margin-bottom: 1cm;
          margin-left:   1cm;
          margin-right:  1cm;
          font-family: "Tahoma", serif;
      }

      /** 
      * Define the width, height, margins and position of the watermark.
      **/
      #watermark {
          position: fixed;
          bottom:   0px;
          left:     0px;
          top:     0px;
          /** The width and height may change 
              according to the dimensions of your letterhead
          **/
          width:    21.8cm;
          height:   28cm;

          /** Your watermark should be behind every content**/
          z-index:  -1000;
      }
      .page-break {
          page-break-after: always;
      }
  </style> 
</head>
  <body>
  <div id="watermark">
   <!-- <img src="{{ public_path().'/images/formato.jpg' }}" width="100%" height="100%">-->
  </div>
    <main>
    @foreach($entradas as $entrada)
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 160mm; top:45mm; right: 0px; height: 300px;  color:black;">{{ $entrada->id }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 60mm; top:55mm; right: 0px; height: 300px;  color:black;">{{ $entrada->fecha }}</p>      
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 140mm; top:65mm; right: 0px; height: 300px;  color:black;">{{ $entrada->nfactura }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 45mm; top:73mm; right: 0px; height: 300px;  color:black;">{{ $entrada->concepto }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 55mm; top:97mm; right: 0px; height: 300px;  color:black;">{{ $entrada->observacion }}</p>

      <table border="0" cellspacing="0" cellpadding="0"  style="width:90%; font:8pt; font-family: sans-serif ; left:10mm;  top:115mm;  color:black;">
        <thead>
          <tr>
            <th class="no" style="width:5%;">ID</th>
            <th class="desc" style="width:30%;">Producto</th>
            <th class="desc" style="width:10%;">Cantidad</th>
            <th class="unit" style="width:15%;">Precio unitario</th>
            <th class="unit" style="width:15%;">Immporte</th>
          </tr>
        </thead>
        <tbody>
          {{$total_productos = 0}}
          {{$total_factura=0}}
          {{$subtotal = 0}}
          @foreach($entradaproductos as $productos)
            @if($productos->id_entrada == $entrada->id)
            <tr>
              <td class="no">{{ $entrada->id }}</td>
              <td class="desc">{{ $productos->nombre_producto }}</td>
              <td class="unit">{{ $productos->cantidad }}</td>
              <td class="unit">$ {{ number_format($productos->costo_unitario,2) }}</td>
              <td class="unit">$ {{ number_format($productos->costo_unitario*$productos->cantidad,2) }}</td>
            </tr>
              {{$total_productos  = $total_productos + $productos->cantidad}}
              {{$total_factura    = $total_factura + $productos->costo_unitario}}
              {{$subtotal         = $subtotal + $productos->costo_unitario*$productos->cantidad}}
            @endif            
          @endforeach          
            <tr>
              <td></td>
              <td class="desc"><b>TOTALES: </b></td>
              <td class="unit"><b>{{$total_productos}}</b></td>
              <td class="unit"><b>$ {{number_format($total_factura,2)}}</b></td>
              <td class="unit"><b>$ {{number_format($subtotal,2)}}</b></td>
            </tr>
        </tbody>

      </table>
        @if($loop->last)
        @else  
        <div class="page-break"></div>
        @endif
      
    @endforeach
    </main>
   <!-- -->
  </body>
</html>