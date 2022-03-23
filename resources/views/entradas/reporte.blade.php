@extends("layout.plantilla")

@section("content")
 <!-- SELECT2 EXAMPLE -->
<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Reportes de entradas a almacén </h3>
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
              <label for="exampleInputEmail1">Fecha inicial</label>
              <input type="date" class="form-control" id="fecha1"  name="fecha1" >
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">Fecha final</label>
              <input type="date" class="form-control" id="fecha2" name="fecha2">
          </div>                         
          <!-- /.form-group -->
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button type="button" id="btn-buscar" class="btn btn-block btn-success">Buscar</button>
            </div> 
            <div class="form-group">
                <button type="button" id="btn-reportePDF" class="btn btn-block btn-primary">PDF</button>
            </div> 
        </div>
        <!-- /.col -->
      </div>      
    </form>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <table id="entradas" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No de entrada</th>
                <th>Fecha</th>
                <th>No. de factura</th>
                <th>Concepto</th>
                <th>Status</th>
                <th>Accion</th>                
              </tr>
              </thead>
            </table>
          </div>        
        </div>
        </div>
  </section> 
<!-- /.row -->
@endsection
@section('scriptpersonal')
<script>
    $(function(){
      //funcion cargar datos de la factura datatble automatico
      $('#entradas').DataTable({
        processing: true,
        serverSide: false,
          ajax: "/entradas/",
          columns:[
        {
          data: 'id',
          name: 'id'
        },
        {
          data: 'fecha',
          name: 'fecha'
        },
        {
          data: 'nfactura',
          name: 'nfactura'
        },
        {
          data: 'concepto',
          name: 'concepto'
        },
        {
          data: 'status',
          name: 'status'
        },
       /* {
          data: 'costo_unitario',
          render: function ( data, type, row ) {
              // Combine the first and last names into a single table field
              return '$ '+data ;
          } 
        },*/
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
            { width: 500, targets: 2 }
        ]
      });
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
        window.open('/entradas/reportepdffecha/'+fecha1+'/'+fecha2, '_blank');   
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
      window.open('/entradas/reportepdf/'+id_entrada, '_blank');
    }); 
</script>
      <!-- /.box -->
@endsection("contenidoprincipal")
