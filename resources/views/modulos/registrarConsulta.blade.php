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
      <div class="row" id="principalRow">
        <div class="col-md-10">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Panel de registro</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="row" id="searchRow">
              <div class="col-md-12">
                <form role="form" method="POST" action="">
                {{csrf_field()}}
                <div class="card">
                <div class="card-header">
                  Panel de búsqueda
                </div>
                <div class="card-body">
                  <p>Ingrese la información necesaria para buscar el expediente</p>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Numero de expedinte</label>
                        <input type="text" class="form-control" id="idExpediente" name="idExpediente" placeholder="Ingrese el numero de expediente" >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="Buscar" />
                  <a href="{{ url('/inicio') }}"><input class="btn btn-danger" value="Cancelar"/></a>
                </div>
                </div> 
              </form>
              </div>
            </div>
            <div class="row" id="searchTable">
              <div class="col-md-10">
                <table id="table" class="table table-head-fixed text-nowrap">
                  <thead>
                      <tr>
                      <th>NUMERO DE EXPEDIENTE</th>
                      <th>NOMBRE DEL PACIENTE</th>
                      <th>NOMBRE DEL DUEÑO</th>
                      <th>TELÉFONO</th>
                      <th>ACCIONES</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>Expediente</td>
                        <td>Mascota</td>
                        <td>Dueño</td>
                        <td>Telefono</td>
                        <td>
                            <form method="post" action="" style="display:inline">
                                {{csrf_field()}}
                                <input type="hidden" name="idExpediente" value=""/>
                                <button type="submit" name="Ver" class="btn btn-info">Seleccionar</button>
                            </form>  
                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row" id="profileRow">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Información de expediente
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Numero de expediente:</label><br>
                        <label>Nombre del paciente:</label><br>
                        <label>Edad:</label><br>
                        <label>Tipo de mascota:</label><br>
                        <label>Raza:</label><br>
                      </div>
                      <div class="col-md-6">
                        <label>Fecha de registro:</label><br>
                        <label>Nombre del dueño:</label><br>
                        <label>Teléfono:</label><br>
                        <label>Dirección:</label><br>
                      </div>
                    </div>
                    <div class="row">
                    <p>Historial</p>
                      <table id="tableConsult" class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                            <th>NO.</th>
                            <th>FECHA CONSULTA</th>
                            <th>OBSERVACIONES</th>
                            <th>DOCTOR QUE ATENDIO</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>Numero</td>
                              <td>Fecha</td>
                              <td>Observacion</td>
                              <td>Doctor</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" id="consult">
              <div class="col-md-12">
                <form role="form" method="post" action="">
                  <div class="card">
                    <div class="card-header">
                      Registro de consulta
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del doctor</label>
                        <input type="text" class="form-control" id="doctorConsulta" name="doctorConsulta" placeholder="Doctor que atiende"  required >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Observaciones</label>
                        <input type="text" class="form-control" id="descripcionRenglonConsulta" name="descripcionRenglonConsulta" placeholder="Descripción o recetas"  required >
                      </div>
                    </div>
                    <div class="card-footer">
                      <input type="hidden" name="idExpediente">
                      <input type="submit" class="btn btn-primary" value="Registrar" />
                      <a href="{{ url('/inicio') }}"><input class="btn btn-danger" value="Cancelar"/></a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
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