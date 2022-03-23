@extends("layout.plantilla")

@section("contenidoprincipal")
 <!-- SELECT2 EXAMPLE -->
 <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Actualizar Productos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form id="sample_form" name="sample_form" role="form" method="post" action="{{url('/productos/'.$producto->id)}}"  enctype="multipart/form-data" >
        @csrf
        {{method_field('PATCH')}}
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Codigo de producto</label>
                  <input type="text" class="form-control" id="codigo_barras" name="codigo_barras"  value="{{ $producto->codigo_barras}}">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Nombre del Producto</label>
                  <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="{{ $producto->nombre_producto}}">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Unidad de Medida</label>
                <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" value="{{ $producto->unidad_medida}}">
              </div>                     
              <!-- /.form-group -->
             
            </div>
            <!-- /.col -->
            <div class="col-md-4">                              
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Precio Costo</label>
                  <input type="text" class="form-control" id="precio_costo" name="precio_costo" value="{{ $producto->precio_costo}}">
              </div>
              <!-- /.form-group -->
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Precio venta</label>
                  <input type="text" class="form-control" id="precio_venta" name="precio_venta" value="{{ $producto->precio_venta}}">
              </div>                 
              <div class="form-group">
                  <label for="exampleInputEmail1">Precio Mayoreo</label>
                  <input type="text" class="form-control" id="precio_mayoreo" name="precio_mayoreo" value="{{ $producto->precio_mayoreo}}">
              </div>              
              <!-- /.form-group -->
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-4">                       
              
            <!--  <div class="form-group">
                  <label for="exampleInputEmail1">RFC</label>
                  <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $producto->responsable_sucursal}}">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">telefono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $producto->responsable_sucursal}}">
              </div>            
              <div class="form-group">
                  <label for="exampleInputEmail1">E-mail</label>
                  <input type="text" class="form-control" id="email" name="email"  value="{{ $producto->responsable_sucursal}}">
              </div>-->
              
              
            </div>
            <!-- /.col -->
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Registro Actualizado!!');">Actualizar</button>
          </div>
        </form>
          <!-- /.row -->
          
        </div>

        
          <!-- /.box -->
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
      </div>
      <!-- /.box -->
@endsection("contenidoprincipal")
