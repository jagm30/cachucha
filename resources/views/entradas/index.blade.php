@extends("layout.plantilla")

@section("content")
 <!-- SELECT2 EXAMPLE -->
 <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Registro de entradas a almacén</h3>

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
              <input type="date" class="form-control" id="fecha"  name="fecha" required="required" >
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">No de factura</label>
              <input type="text" class="form-control" id="nfactura" name="nfactura"  required="required" placeholder="Ingresa el No de factura">
          </div>
          <!-- /.form-group -->                                        
        </div>
        <!-- /.col -->
        <div class="col-md-4">                              

           <div class="form-group">
            <label>Concepto</label>
            <input type="text" id="concepto" name="concepto" class="form-control" required>
          </div>  
          <!-- /.form-group -->
          <!-- /.form-group -->
          <div class="form-group">
            <label for="exampleInputEmail1">Proveedor</label>                
            <input type="text" name="id_proveedor" id="id_proveedor" class="form-control" readonly value="1">
          </div> 
          <!-- /.form-group -->

        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-4">    
          <div class="form-group">
            <label>Sucursal</label>
            <input type="text" readonly name="id_sucursal" id="id_sucursal" value="1" class="form-control">
          </div>                    
          <!-- /.form-group -->
          <div class="form-group">
              <label for="exampleInputEmail1">Observaciones</label>
              <input type="text" class="form-control" id="observacion" name="observacion" required="required" placeholder="Observaciones">
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Siguiente</button>
    </div>
  </form>
<!-- /.row -->
@endsection
@section('scriptpersonal')
<script>
    $(function(){
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
</script>
      <!-- /.box -->
@endsection("contenidoprincipal")
