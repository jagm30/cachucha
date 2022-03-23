
@extends("layout.plantilla")
@section("content")
 <!-- SELECT2 EXAMPLE -->
 <div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Registro de entradas a almacén </h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
        <!-- /.box-header -->
  <div class="box-body">
    <form id="sample_form" name="sample_form" role="form" method="post" action="/entradas"  enctype="multipart/form-data" >
    @csrf
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
              <label for="exampleInputEmail1">Fecha</label>
              <input type="date" class="form-control" id="fecha"  name="fecha" readonly value="{{$entrada->fecha}}" >
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">No de factura</label>
              <input type="text" class="form-control" id="nfactura" name="nfactura"  readonly value="{{$entrada->nfactura}}">
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-4">                              
          <!-- /.form-group -->
          <div class="form-group">
              <label for="exampleInputEmail1">Concepto</label>
              <input type="text" class="form-control" id="concepto" name="concepto"  required="required" placeholder="Ingresa el concepto de la entrada" value="{{$entrada->concepto}}" readonly  >
          </div>
          <!-- /.form-group -->
          <!-- /.form-group -->
          <div class="form-group">
            <label for="exampleInputEmail1">Proveedor</label>                
            <input id="id_proveedor" name="id_proveedor" class="form-control" value="{{$entrada->id_proveedor}}" readonly>
          </div> 
          <!-- /.form-group -->

        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-4">                       
          <!-- /.form-group -->
          <div class="form-group">
              <label for="exampleInputEmail1">Observaciones</label>
              <input type="text" class="form-control" id="observacion" name="observacion" required="required" placeholder="Observaciones" value="{{$entrada->observacion}}" readonly>
          </div>
          
          <div class="form-group">
              <h2>No de entrada: <b style="color: red;">{{$entrada->id}}</b></h2>
          </div>

          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>      
    </form>
    <div class="box-footer">
    @if($entrada->status!='finalizado')<button type="button" data-id="{{$entrada->id}}" id="btn-agregarproducto" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-success">Agregar producto</button>
    @endif
    </div>
  <!-- /.row -->    
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
        <table id="alumnos_table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id entrada</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio unitario</th>
              <th>Accion</th>

              
            </tr>
            </thead>
          </table>
        </div>        
      </div>
      <div class="box-footer">
          @if($entrada->status!='finalizado')<button type="button" data-id="{{$entrada->id}}" id="btn-finalizar" name="btn-finalizar" class="btn btn-block btn-danger" data-toggle="modal" >Finalizar entrada</button>
          @else
            <button type="button" data-id="{{$entrada->id}}" id="btn-pdf" name="btn-pdf" class="btn btn-block btn-info" >PDF</button>
          @endif

      </div>
    </div>
  </section> 
   <!-- /.modal -->

 <div class="modal modal-success fade" id="modal-success">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Agregar productos</h4>
        </div>
        <form id="form-editar">
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">               
                <div class="form-group">
                  <label>Productos</label>
                  <select class="form-control select2"  style="width: 100%;" id="id_producto" name="id_producto" onchange="cargarPrecioProducto();">
                    <option value="">Seleccione una opcion</option>
                    @foreach($productos as $producto)
                      <option value="{{$producto->id}}">{{$producto->nombre_producto}}</option>
                    @endforeach
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">              
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Costo unitario</label>
                    <input type="text" class="form-control" id="costo_unitario" name="costo_unitario" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Unidad de medida</label>
                    <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" readonly>
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
                <!-- /.form-group -->
                <!-- /.form-group -->             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <!-- /.col -->
              <div class="col-md-6">              
                <!-- /.form-group -->
                <div class="form-group">
                  <input type="hidden" class="form-control" name="id_sucursal" id="id_sucursal" value="1">
                    <label for="exampleInputEmail1">Cantidad</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad"  placeholder="Ingresa la Cantidad">
                </div>
          
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
          </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="button" data-id="{{$entrada->id}}" class="btn btn-outline" id="btn-guardarproducto">Agregar producto</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->            
@endsection
@section('scriptpersonal')
<script>
    $(function(){
      //funcion cargar datos de la factura datatble automatico
      $('#alumnos_table').DataTable({
        processing: true,
        serverSide: true,
          ajax: "/entradas/"+{{$entrada->id}},
          columns:[
        {
          data: 'id_entrada',
          name: 'id_entrada'
        },
        {
          data: 'nombre_producto',
          name: 'nombre_producto'
        },
        {
          data: 'cantidad',
          name: 'cantidad'
        },
        {
          data: 'costo_unitario',
          render: function ( data, type, row ) {
              // Combine the first and last names into a single table field
              return '$ '+data ;
          } 
        },
        {
        data: 'action',
        name: 'action',
        orderable: false
        }
      ],
      searching: true,
      autoWidth: false,      
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
        $('#searchBox').css("width", "200px").focus();
      },
      columnDefs: [
            { width: 500, targets: 1 }
        ]
      });

     
    //Agregar producto
    $('#btn-guardarproducto').on('click', function() {
      
      var id_entrada      = $(this).attr('data-id');
      var id_producto     = $('#id_producto').val();
      var costo_unitario  = $('#costo_unitario').val();
      var cantidad        = $('#cantidad').val();
      var id_sucursal     = $('#id_sucursal').val();
      var id_usuario      = <?php echo auth()->id();?>;

      //alert(id_usuario);
      //   $("#butsave").attr("disabled", "disabled");
        $.ajax({
            url: "/entradasproductos",
            type: "POST",
            data: {
                _token: $("#csrf").val(),
                type: 1,
                id_entrada:     id_entrada,
                id_producto:    id_producto,
                costo_unitario: costo_unitario,
                cantidad:       cantidad,
                id_sucursal:    id_sucursal,
                status:         'activo',
                id_usuario:     id_usuario
            },
            cache: false,
            success: function(dataResult){
                alert(dataResult);     
                $('#alumnos_table').DataTable().ajax.reload();           
                $('#form-editar').trigger("reset");              
            }
        });    
    });
// eliminar articulo de la entrada
    $('body').on('click', '#btn-eliminar', function () {
      var entradaproducto_id = $(this).data("id");
     // alert(entradaproducto_id);
      if(confirm("Estas seguro que deseas eliminar el producto?")){
        $.ajax({
            type: "get",
            url: "{{ url('entradasproductos/delete') }}"+'/'+ entradaproducto_id,
            success: function (data) {
              alert(data.mensaje);
              $('#alumnos_table').DataTable().ajax.reload();
            }
        });
      }
    }); 
//finalizar captura de la factura
    $('body').on('click', '#btn-finalizar', function () {
      var id_entrada = $(this).data("id");
      //alert(id_entrada);
      if(confirm("Estas seguro que deseas finalizar la captura?")){
        $.ajax({
            type: "get",
            url: "{{ url('entradasproductos/finalizar') }}"+'/'+ id_entrada,
            success: function (data) {
              alert(data.mensaje);
              location.reload();

             // $('#alumnos_table').DataTable().ajax.reload();
            }
        });
      }
    }); 
//pdf reporte
    $('body').on('click', '#btn-pdf', function () {
      var id_entrada = $(this).data("id");          
      window.open('/entradas/reportepdf/'+id_entrada, '_blank');          
    }); 
    //cargar precio de producto
    
    

     //// funciones varias
        //Date picker
        $('#fecha').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
            });
        //Initialize Select2 Elements
        $('.select2').select2()
        //input mask
        $(".decimal").inputmask('decimal', {
            rightAlign: false,
            groupSeparator: ',',
            autoGroup: true,
            digits: 2, 
            digitsOptional: false, 
            prefix: '$ ', 
            placeholder: '0',
            removeMaskOnSubmit: true,
        });
        $(".input-number").on('input', function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });
    });
    //consultar precio de producto
    function cargarPrecioProducto(){
      id_producto = $('#id_producto').val();
      $.ajax({
            type: "get",
            url: "{{ url('productos') }}"+'/'+ id_producto,
            success: function (data) {
              $('#costo_unitario').val(data.precio_venta);
              $('#unidad_medida').val(data.unidad_medida);
            }
        });
    }
</script>

@endsection()
