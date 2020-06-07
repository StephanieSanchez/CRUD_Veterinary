@extends('plantilla')
@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de consulta</h1>
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
              <form role="form" method="POST" action="{{ url('/createProfile') }}">
              {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Clave de producto</label>
                    <input type="text" class="form-control" id="clave_pro" name="clave_acc" placeholder="Ingrese el código"  required >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Producto</label>
                    <input type="text" class="form-control" id="nombre_pro" name="nombre_acc" placeholder="Nombre del producto" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Descripción</label>
                    <input type="text" class="form-control" id="desc_pro" name="desc_acc" placeholder="Breve descripción" required>
                  </div>
                  <label for="exampleInputFile">Precio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" id="pre_pro" name="precio_acc" placeholder="00.00" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Cantidad</label>
                    <input type="number" class="form-control" id="exis_pro" name="existencia" placeholder="Cantidad a registrar" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="Registrar" />
                  <a href="{{ url('/inicio') }}"><input class="btn btn-danger" value="Cancelar"/></a>
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


@endsection