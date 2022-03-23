<!DOCTYPE html>
<html lang="es">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Example 2</title>
  
  
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
   
  </div>
    <main>
      <p style="font:12pt; font-family: sans-serif ; position: fixed; left: 100mm; top:20mm; right: 0px; height: 300px;  color:black;"><b>ALMACÉN</b></p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 160mm; top:30mm; right: 0px; height: 300px;  color:black;"><b>No. de entrada:</b>{{ $entrada->id }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 20mm; top:35mm; right: 0px; height: 300px;  color:black;"><b>Fecha: </b>{{ $entrada->fecha }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 20mm; top:40mm; right: 0px; height: 300px;  color:black;"><b>Proveedor: </b>{{ $entrada->id_proveedor }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 140mm; top:40mm; right: 0px; height: 300px;  color:black;"><b>No de Factura: </b>{{ $entrada->nfactura }}</p>
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 20mm; top:45mm; right: 0px; height: 300px;  color:black;"><b>Concepto: </b>{{ $entrada->concepto }}</p>
      
      <p style="font:10pt; font-family: sans-serif ; position: fixed; left: 20mm; top:60mm; right: 0px; height: 300px;  color:black;"><b>Observaciones: </b>{{ $entrada->observacion }}</p>
      <br><br><br><br><br><br><br><br><br><br>
      <table border="0" cellspacing="0" cellpadding="0" class="table table-sm"  style="width:90%; font:8pt; font-family: sans-serif ;  left:10mm;  top:auto;  color:black;">
        <thead>
          <tr>
            <th class="no" style="width:10%;">ID</th>
            <th class="desc" style="width:30%;">Producto</th>
            <th class="cant" style="width:5%;">Cantidad</th>
            <th class="unit" style="width:10%;">Precio unitario</th>
          </tr>
        </thead>
        <tbody>
          @foreach($entradaproductos as $productos)
            <tr>
              <td class="no">{{ $productos->id_producto }}</td>
              <td class="desc">{{ $productos->nombre_producto }}</td>
              <td class="cant">{{ $productos->cantidad }}</td>
              <td class="unit">{{ $productos->costo_unitario }}</td>
            </tr>
          @endforeach          
        </tbody>

      </table>
    </main>
   <!-- <div class="page-break"></div>-->
   <script type="text/php">
    if ( isset($pdf) ) {
        //$font = Font_Metrics::get_font("helvetica", "bold");
        $pdf->page_text(500, 800, "Página: {PAGE_NUM} de {PAGE_COUNT}", "arial", 8, array(0,0,0));
    }
</script>
  </body>
</html>