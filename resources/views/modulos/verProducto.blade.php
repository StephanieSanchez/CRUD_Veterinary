@extends('plantilla')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consulta de productos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Panel de registro</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ url('/update') }}">
                {{ csrf_field() }}
               @foreach($accesorio as $acc)
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Clave de producto</label>
                    <input type="text" class="form-control" id="clave_acc" name="clave_acc" value="{{$acc->clave_acc }}" readonly placeholder="Ingrese el código" required >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Producto</label>
                    <input type="text" class="form-control" id="nombre_acc" name="nombre_acc" value="{{$acc->nombre_acc }}" placeholder="Nombre del producto" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Descripción</label>
                    <input type="text" class="form-control" id="desc_acc" name="desc_acc" value="{{$acc->desc_acc }}" placeholder="Breve descripción" required>
                  </div>
                  <label for="exampleInputFile">Precio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" id="precio_acc" name="precio_acc" value="{{$acc->precio_acc }}" placeholder="00.00" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Cantidad</label>
                    <input type="number" class="form-control" id="existencia" name="existencia" value="{{$acc->existencia }}"  placeholder="Cantidad a registrar" required>
                  </div>
                </div>
                <!-- /.card-body -->
                @endforeach
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="Guardar cambios" />
                  <a href="{{ url('/show') }}"><input class="btn btn-danger" value="Cancelar"/></a>
                </div>
              </form>
            </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</script>
@endsection