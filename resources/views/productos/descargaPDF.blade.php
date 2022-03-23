<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 1.5cm 1.5cm 1.5cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2c2b64;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 5px;
        }
    </style>
</head>
<body>
<header>
    <h1>Cachuchas</h1>
</header>

<main>
    <h1>Lista de productos</h1>
    <table border="1" cellspacing="0" cellpadding="3"  style="width:80%; font:10pt; font-family: sans-serif ; position: fixed; left:10mm;  top:4cm;  color:black; " >
        <thead>
          <tr>
            <th class="no" style="width:320px;">Nombre</th>
            <th class="desc" style="width:80px;">Codigo de barras</th>
            <th class="unit" style="width:50px;">Unidad</th>
            <th class="unit" style="width:85px; ">P. Proveedor</th>
            <th class="unit" style="width:82px;">P. Publico</th>            
            <th class="unit" style="width:82px;">P. Mayorreo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto)
            <tr>
              <td class="no">{{ $producto->nombre_producto }}</td>
              <td class="desc">{{ $producto->codigo_barras }}</td>
              <td class="unit">{{ $producto->unidad_medida }}</td>
              <td class="unit" align="right">$ {{ number_format($producto->precio_costo,2) }}</td>              
              <td class="unit" align="right">$ {{ number_format($producto->precio_venta,2) }}</td>              
              <td class="unit" align="right">$ {{ number_format($producto->precio_mayoreo,2)}}</td>
            </tr>
          @endforeach          
       
        </tbody>
      </table>
</main>

<footer>
    <h3>www.cachuchas.com</h3>
</footer>
</body>
</html>