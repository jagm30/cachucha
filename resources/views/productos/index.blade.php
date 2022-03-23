@extends("layout.plantilla")

@section("content")
 <!-- SELECT2 EXAMPLE -->
 <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de productoss</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form id="sample_form" name="sample_form" role="form" method="post" action="/productos"  enctype="multipart/form-data" >
        @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Codigo de Producto</label>
                  <input type="text" required class="form-control" id="codigo_barras" name="codigo_barras" placeholder="Ingresa el codigo de producto">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Nombre del producto</label>
                  <input type="text" required class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingresa el Nombre del producto">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">   
              <div class="form-group">
                <label>Unidad de medida</label>
                <select class="form-control select2"  style="width: 100%;" id="unidad_medida" name="unidad_medida" required>
                  <option selected="selected">Pieza</option>
                  <option>Rollo</option>
                  <option>Litros</option>
                  <option>Metros</option>
                  <option>Par</option>
                  <option>Rollo</option>
                  <option>Set</option>
                  <option>Kilos</option>
                  <option>Multiusos</option>

                </select>
              </div>           
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Precio costo</label>
                  <input type="text" required class="form-control" id="precio_costo" name="precio_costo" placeholder="Ingresa el Precio costo">
              </div>
            </div>
            <div class="col-md-4">                            
              <!-- /.form-group -->
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Precio venta</label>
                  <input type="text" required class="form-control" id="precio_venta" name="precio_venta" placeholder="Ingresa el Precio venta">
              </div>
              <!-- /.form-group -->
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Precio mayoreo</label>
                  <input type="text" required class="form-control" id="precio_mayoreo" name="precio_mayoreo" placeholder="Ingresa el Precio mayoreo">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
          <!-- /.row -->
          
        </div>

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Productos registrados</h3>
            </div>
            <br>
            <div class="box-footer">
              <a href="/productos/descargarExcel/" target="_blank"> <button type="button" class="btn btn-primary"> Exportar a Excel</button> </a>
              <a href="/productos/descargarPDF/" target="_blank"><button type="button" class="btn btn-success">Exportar a PDF</button> </a>
            </div>
            <br>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" name="example1" class="table table-bordered table-striped">
                <thead>
                <tr>                  
                  <th>ID</th>
                  <th>Codigo de Producto</th>
                  <th>Nombre del producto</th> 
                  <th>Unidad de medida</th>
                  <th>Precio costo</th>
                  <th>Precio venta</th>
                  <th>Precio mayoreos</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productos as $producto)              
                  <tr>
                    <td>{{ $producto->id }} </td>
                    <td>{{ $producto->codigo_barras }} </td>
                    <td>{{ $producto->nombre_producto }} </td>
                    <td>{{ $producto->unidad_medida }} </td>
                    <td>{{ $producto->precio_costo }} </td>
                    <td>{{ $producto->precio_venta }} </td>
                    <td>{{ $producto->precio_mayoreo }} </td> 
                    <td>

                        <button type="button" data-id="{{$producto->id}}" id="btn-editar" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#modal-success">Editar</button>
                        <br>
                      <form method="post" action="{{url('/productos/'.$producto->id)}}">
                        {{csrf_field()}} 
                        {{method_field('DELETE') }}
                        <button type="submit" class="btn btn-block btn-danger  btn-xs" onclick="return confirm('esta seguro de eliminar el producto');"> Eliminar</button>                      
                      </form>
                    </td>
                  </tr>                              
                  </tr>
                @endforeach
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      </div>

 <!-- /.modal -->

 <div class="modal modal-success fade" id="modal-success">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edición</h4>
        </div>
        <form id="form-editar">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                {!! csrf_field() !!}
                <div class="form-group">
                  <input type="hidden" value="" class="form-control" name="id" id="id" >
                    <label for="exampleInputEmail1">Codigo de Producto</label>
                    <input type="text" class="form-control" id="codigo_barras-e" name="codigo_barras-e" placeholder="Ingresa el codigo de producto">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre_producto-e" name="nombre_producto-e" placeholder="Ingresa el Nombre del producto">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Unidad de medida</label>
                  <select class="form-control select2"  style="width: 100%;" id="unidad_medida-e" name="unidad_medida-e">
                    <option value="Pieza">Pieza</option>
                    <option value="Rollo">Rollo</option>
                    <option value="Litros">Litros</option>
                    <option value="Metros">Metros</option>
                    <option value="Par">Par</option>
                    <option value="Rollo">Rollo</option>
                    <option value="Set">Set</option>
                    <option value="Kilos">Kilos</option>
                    <option value="Multiusos">Multiusos</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">              
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Precio costo</label>
                    <input type="text" class="form-control" id="precio_costo-e" name="precio_costo-e" placeholder="Ingresa el Precio costo">
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Precio venta</label>
                    <input type="text" class="form-control" id="precio_venta-e" name="precio_venta-e" placeholder="Ingresa el Precio venta">
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Precio mayoreo</label>
                    <input type="text" class="form-control" id="precio_mayoreo-e" name="precio_mayoreo-e" placeholder="Ingresa el Precio mayoreo">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <!-- /.col -->

              <!-- /.col -->
            </div>
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-outline" id="btn-guardareditar">Guardar cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->

@endsection("content")
@section("scriptpersonal")
<script >
  $(function () {
    $('#example1').DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
      },
      "search": {
            "addClass": 'form-control input-lg col-xs-12'
      },
      "fnDrawCallback":function(){
        $("input[type='search']").attr("id", "searchBox");            
        $('#searchBox').css("width", "400px").focus();
      }
    })
  })
  $(document).on("click", "#btn-editar", function () {
    //alert("accediendo a la edicion..."+$(this).attr('data-id'));
    var id_producto = $(this).attr('data-id');
    $("#nombre_producto_e").val(nombre_producto);
    $.ajax({
        /* acceso al controlador show */
        url: '/productos/'+id_producto,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) { 
          $("#codigo_barras-e").val(data.codigo_barras);
          $("#nombre_producto-e").val(data.nombre_producto);
          $("#unidad_medida-e option[value="+data.unidad_medida+"]").attr("selected", true);
          $("#precio_costo-e").val(data.precio_costo);
          $("#precio_venta-e").val(data.precio_venta);
          $("#precio_mayoreo-e").val(data.precio_mayoreo);
          $("#cant_minima-e").val(data.cant_minima);
          $("#existencia_actual-e").val(data.existencia_actual);    
          $("#id").val(id_producto);              
        }
    }); 
  });

  $(document).on("click", "#btn-guardareditar", function () {
    
    datos = $('#form-editar').serialize();
    
    $.ajax({
            //url: "/productos/edicion/"+$.param(datos),
            url: "/productos/edicion/",
            headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
            type: "POST",
            cache: false,
            data:datos,
            success: function(dataResult){              
                alert(dataResult.mensaje);   
                location.reload();        
                //$('#form-abono').trigger("reset");                                      
                //alert(total);
               // number_format(subtotal, 2, '.', ',') 

                //alert($('#total').val());
            }
        });  
  });
</script>
@endsection("scriptpersonal")