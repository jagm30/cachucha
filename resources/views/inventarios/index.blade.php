@extends("layout.plantilla")

@section("content")
<style type="text/css">
.form-control {
    height: 37px;
}
.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
</style>
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Inventario</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
    <div class="box-body">           
		<section class="content">
			<div class="card-body">          
				<a class="btn btn-warning" href="{{ route('exportinventario') }}">Exportar datos a excel</a>
			</div>
			<div class="row">
			  <div class="col-xs-12">
			    <div class="box">
			    <table id="inventario" class="table table-bordered table-striped">
			        <thead>
			        <tr>
			          <th>Codigo de barras</th>
			          <th>Producto</th>
			          <th>Costo unitario</th>
			          <th>P. mayoreo.</th>
			          <th>Existencia</th>                            
			        </tr>
			        </thead>
			      </table>
			    </div>        
			  </div>
			</div>
		</section> 
  	</div>
</div>

<div class="modal modal-success fade" id="Quitar::modal-success" >
    <div class="modal-dialog">
      <div class="modal-content">
      	
        <div class="modal-header">
          	<div class="stepwizard">
	            <div class="stepwizard-row setup-panel">
	                <div class="stepwizard-step">
	                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
	                    <p>Entradas</p>
	                </div>
	                
	                <div class="stepwizard-step">
	                    <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>
	                    <p>Ventas</p>
	                </div>
	                
	                <div class="stepwizard-step">
	                    <a href="#step-3" type="button" class="btn btn-default btn-circle">3</a>
	                    <p>Traspasos</p>
	                </div>
                  <div class="stepwizard-step">
                      <a href="#step-4" type="button" class="btn btn-default btn-circle">4</a>
                      <p>Devoluciones</p>
                  </div>
	                
	            </div>
	        </div>
        </div>
		       
          <div class="modal-body">
          	<div class="row setup-content" id="step-1">
                    <div class="col-md-12"> 
		                <h3>Entradas</h3>      
		                <div class="row">
		                  <div class="col-xs-12">
		                    <div class="box">
		                    <table id="mov_kardex" class="table table-striped table-bordered" style="color: black; max-width: 100px; padding: 0.857em 0.587em;">
		                        <thead>
		                        <tr>
		                          <th>ID</th>
		                          <th>ID Entrada</th>
		                          <th>Fecha</th>
		                          <th>Cantidad</th>    
		                          <th>Ver</th>                        
		                        </tr>
		                        </thead>
		                        <tfoot>
						            <tr>
						                <th></th>
						                <th></th>						                
						                <th>Total:</th>
						                <th></th>
						            </tr>
						        </tfoot>
		                      </table>
		                    </div>        
		                  </div>
		                </div>
		                <!-- /.form-group -->
		                
		                <input type="hidden" name="id_sucursal" id="id_sucursal" class="form-control" value="{{session('sessionsucursal')}}">
		             </div>
               </div>

               <div class="row setup-content" id="step-2">
                    <div class="col-md-12">              
		                <h3>Ventas</h3>
		                <div class="row">
		                  <div class="col-xs-12">
		                    <div class="box">
		                    <table id="mov_kardexventa" class="table table-bordered table-striped" style="color: black;">
		                        <thead>
		                        <tr>
		                          <th>ID</th>
		                          <th>ID Venta</th>
		                          <th>Fecha</th>
		                          <th>Cantidad</th>    
		                          <th>Ver</th>                        
		                        </tr>
		                        </thead>
		                        <tfoot>
						            <tr>
						                <th></th>
						                <th></th>						                
						                <th>Total:</th>
						                <th></th>
						            </tr>
						        </tfoot>
		                      </table>
		                    </div>        
		                  </div>
		                </div>
		              </div>
               </div>

               <div class="row setup-content" id="step-3">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                          <h3> Traspasos</h3>
                          
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="box">
                              <table id="mov_kardextraspaso" class="table table-bordered table-striped" style="color: black;">
                                  <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Suc. origen</th>
                                    <th>Suc. destino</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>    
                                    <th>Ver</th>                        
                                  </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th></th>
                                          <th></th>   
                                          <th></th>                           
                                          <th>Total:</th>
                                          <th></th>
                                      </tr>
                                  </tfoot>
                                </table>
                                </div>
                              </div>
                            </div>
                          <!-- content go here -->
                          
                      </div>
                  </div>
               </div>
               <div class="row setup-content" id="step-4">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                          <h3> Devoluciones</h3>
                          
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="box">
                              <table id="mov_kardexdevolucion" class="table table-bordered table-striped" style="color: black;">
                                  <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>ID Devolucion</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>    
                                    <th>Ver</th>                        
                                  </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th></th>
                                          <th></th>                           
                                          <th>Total:</th>
                                          <th></th>
                                      </tr>
                                  </tfoot>
                                </table>
                                </div>
                              </div>
                            </div>
                          <!-- content go here -->
                          
                      </div>
                  </div>
               </div>
          </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->  

@endsection("contenidoprincipal")

@section('scriptpersonal')
<script>
    $(function(){
      //funcion cargar datos de la factura datatble automatico
      $('#inventario').DataTable({
        processing: true,
        serverSide: true,
          ajax: "/inventarios/",
          columns:[
        {
          data: 'codigo_barras',
          name: 'codigo_barras'
        },
        {
          data: 'nombre_producto',
          name: 'nombre_producto'
        },
        {
          data: 'costo_unitario',
          name: 'costo_unitario'
        },        
        {
        data: 'precio_mayoreo',
        name: 'precio_mayoreo'
        },
        {
          data: 'cantidad',
          name: 'cantidad'
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
      //tabla mov kardex
      //funcion cargar datos de la factura datatble automatico
     /* $('#mov_kardex').DataTable({
        processing: true,
        serverSide: false,
          ajax: "entradasproductos/1",
          columns:[
        {
          data: 'nombre_producto',
          name: 'nombre_producto'
        },
        {
          data: 'id_entrada',
          name: 'id_entrada'
        },
        {
          data: 'created_at',
          name: 'created_at'
        },        
        {
        data: 'cantidad',
        name: 'cantidad'
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
      "footerCallback": function ( row, data, start, end, display ) {
        
            total = this.api()
                .column(3)//numero de columna a sumar
                //.column(1, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(3).footer()).html(total);
            
        }
     // columnDefs: [
        //    { width: 500, targets: 1 }
       // ]
      });
      //fin tabla mov kardex
      //funcion cargar datos de la factura datatble automatico ventas
      $('#mov_kardexventa').DataTable({
        processing: true,
        serverSide: false,
          ajax: "ventaarticulos/1",
          columns:[
        {
          data: 'nombre_producto',
          name: 'nombre_producto'
        },
        {
          data: 'id_venta',
          name: 'id_venta'
        },
        {
          data: 'created_at',
          name: 'created_at'
        },        
        {
        data: 'cantidad',
        name: 'cantidad'
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
      "footerCallback": function ( row, data, start, end, display ) {
        
            total = this.api()
                .column(3)//numero de columna a sumar
                //.column(1, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(3).footer()).html(total);
            
        },
      "fnDrawCallback":function(){
        $("input[type='search']").attr("id", "searchBox");            
        $('#searchBox').css("width", "200px").focus();
      },
     // columnDefs: [
        //    { width: 500, targets: 1 }
       // ]
      });
      //fin tabla mov kardex venta
      //funcion cargar datos de traspasos
      $('#mov_kardextraspaso').DataTable({
        processing: true,
        serverSide: false,
          ajax: "traspasoproductos/0",
          columns:[
        {
          data: 'nombre_producto',
          name: 'nombre_producto'
        },
        {
          data: 'sucursalorigen',
          name: 'sucursalorigen'
        },
        {
          data: 'sucursaldestino',
          name: 'sucursaldestino'
        },
        {
          data: 'created_at',
          name: 'created_at'
        },        
        {
        data: 'cantidad',
        name: 'cantidad'
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
      "footerCallback": function ( row, data, start, end, display ) {
        
            total = this.api()
                .column(4)//numero de columna a sumar
                //.column(1, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(4).footer()).html(total);
            
        },
      "fnDrawCallback":function(){
        $("input[type='search']").attr("id", "searchBox");            
        $('#searchBox').css("width", "200px").focus();
      },
     // columnDefs: [
        //    { width: 500, targets: 1 }
       // ]
      });
      //fin tabla mov kardex traspaso
      //funcion cargar datos de devoluciones
      $('#mov_kardexdevolucion').DataTable({
        processing: true,
        serverSide: false,
          ajax: "devolucionarticulos/1",
          columns:[
        {
          data: 'nombre_producto',
          name: 'nombre_producto'
        },
        {
          data: 'id_venta',
          name: 'id_venta'
        },
        {
          data: 'created_at',
          name: 'created_at'
        },        
        {
        data: 'cantidad',
        name: 'cantidad'
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
      "footerCallback": function ( row, data, start, end, display ) {
        
            total = this.api()
                .column(3)//numero de columna a sumar
                //.column(1, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(3).footer()).html(total);
            
        },
      "fnDrawCallback":function(){
        $("input[type='search']").attr("id", "searchBox");            
        $('#searchBox').css("width", "200px").focus();
      },
     // columnDefs: [
        //    { width: 500, targets: 1 }
       // ]
      });*/
      //fin tabla mov kardex devolucion
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

    $('body').on('click', '#btn-reportePDF', function () {
        fecha1      = $('#fecha1').val();
        fecha2      = $('#fecha2').val();
        window.open('https://venta.strongersureste.com/entradas/reportepdffecha/'+fecha1+'/'+fecha2, '_blank');   
    }); 
    $('body').on('click', '#btn-movkardex', function () {
        var id_producto = $(this).data("id"); 
        //alert(id_producto);
        $.ajax({
            type: "get",
            url: "{{ url('entradasproductos') }}"+'/'+ id_producto,
            success: function (data) {
             //alert("ok");
              $('#mov_kardex').DataTable().clear().rows.add(data.data).draw(); 
            }
        });
        $.ajax({
            type: "get",
            url: "{{ url('devolucionarticulos') }}"+'/'+ id_producto,
            success: function (data) {
             //alert("ok");
              $('#mov_kardexdevolucion').DataTable().clear().rows.add(data.data).draw(); 
            }
        });
        $.ajax({
            type: "get",
            url: "{{ url('ventaarticulos') }}"+'/'+ id_producto,
            success: function (data) {
             //alert("ok");
              $('#mov_kardexventa').DataTable().clear().rows.add(data.data).draw(); 
            }
        });
        $.ajax({
            type: "get",
            url: "{{ url('traspasoproductos') }}"+'/obtener/'+ id_producto,
            success: function (data) {
             //alert("ok");
              $('#mov_kardextraspaso').DataTable().clear().rows.add(data.data).draw(); 
            }
        });
    }); 
    $('body').on('click', '#btn-entradakardexpro', function () {
        var id_entrada = $(this).data("id");     
        window.open('https://venta.strongersureste.com/entradas/'+id_entrada, '_blank');
    }); 
    $('body').on('click', '#btn-ventakardexpro', function () {
        var id_venta = $(this).data("id");     
        window.open('https://venta.strongersureste.com/ventas/'+id_venta, '_blank');
    });
    $('body').on('click', '#btn-traspasokardex', function () {
        var id_traspaso = $(this).data("id");     
        window.open('https://venta.strongersureste.com/traspasos/'+id_traspaso, '_blank');
    });
    $('body').on('click', '#btn-buscar', function () {
        fecha1      = $('#fecha1').val();
        fecha2      = $('#fecha2').val();
        $.ajax({
            type: "get",
            url: "{{ url('entradas/reportepdffecha') }}"+'/'+fecha1+'/'+fecha2,
            success: function (data) {
              /*actualizar toda la tabla con otra consulta...*/
              $('#entradas').DataTable().clear().rows.add(data.data).draw(); 
            }
        });
    }); 
    $('body').on('click', '#btn-reporte', function () {
      var id_entrada = $(this).data("id");          
      window.open('https://venta.strongersureste.com/entradas/pdf/'+id_entrada, '_blank');
    }); 
</script>

<script type="text/javascript">
$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'), // tab nav items
            allWells = $('.setup-content'), // content div
            allNextBtn = $('.nextBtn'); // next button

    allWells.hide(); // hide all contents by defauld

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    // next button
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url']"),
            isValid = true;
           // Validation
        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
        // move to next step if valid
        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
      <!-- /.box -->
@endsection("scriptpersonal")
