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
           @if(count($errors)>0)
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach($errors -> all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="card-header">
              <h3 class="card-title">Panel de registro</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="row" id="searchRow">
              <div class="col-md-12">
                <form role="form" method="POST" action = "{{ url('/getRecordsCita') }}">
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
                        <label for="exampleInputEmail1">Busqueda del expedinte</label>
                        <input type="text" class="form-control" id="keyExpediente" name="keyExpediente" placeholder="Ingrese el numero, nombre, dueño del expediente" >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="Buscar" />
                  <a href="{{ url('/inicio') }}"><input class="btn btn-danger" value="Cancelar"/></a>
                  <a href="{{ url('/createProfile') }}" class="btn btn-info">Registrar nuevo perfil</a>
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
                    @if(isset($records))
                      @foreach($records as $record)
                        <tr>
                            <td>{{$record->idExpediente}}</td>
                            <td>{{$record->nombreExpediente}}</td>
                            <td>{{$record->dueñoExpediente}}</td>
                            <td>{{$record->telefonoExpediente}}</td>
                            <td>
                                <form method="POST" action = "{{ url('/getRecordCita') }}" style="display:inline">
                                    {{csrf_field()}}
                                    <input type="hidden" name="idExpediente" value="{{$record->idExpediente}}"/>
                                    <button type="submit" name="Ver" class="btn btn-info">Seleccionar</button>
                                </form>  
                            </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            @php $id = ''; $name = ''; $age = ''; $nameOwner = ''; $phone = ''; $address = ''; $petName = ''; $raceName = ''; $date = ''; $cosultation = ''; $historic = ''; $consulta = ''; @endphp
            @isset($recordEx) 
                @php
                    $name = $recordEx->nombreExpediente;
                    $age = $recordEx->edadExpediente;
                    $nameOwner = $recordEx->dueñoExpediente; 
                    $phone = $recordEx->telefonoExpediente; 
                    $address = $recordEx->direccionExpediente;
                    $petName = $recordEx->nombreMascota;
                    $raceName = $recordEx->nombreRaza;
                    $date = $recordEx->fechaExpediente;
                    $id = $recordEx->idExpediente;
                    foreach($consultas as $con){
                        $consulta = $con->idConsulta;
                    }
                @endphp
            @endisset
            @if(isset($recordEx))
            <div class="row" id="profileRow">
            @else
            <div id="profileRow" class="d-none">
            @endif
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Información de expediente
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Numero de expediente: </label>{{$id}}<br>
                        <label>Nombre del paciente: </label>{{$name}}<br>
                        <label>Edad: </label>{{$age}}<br>
                        <label>Tipo de mascota: </label>{{$petName}}<br>
                        <label>Raza: </label>{{$raceName}}<br>
                      </div>
                      <div class="col-md-6">
                        <label>Fecha de registro:</label>{{$date}}<br>
                        <label>Nombre del dueño: </label>{{$nameOwner}}<br>
                        <label>Teléfono: </label>{{$phone}}<br>
                        <label>Dirección: </label>{{$address}}<br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @if(isset($recordEx))
            <div class="row" id="consult">
            @else
            <div id="consult" class="d-none">
            @endif
              <div class="col-md-12">
                <form role="form" method="POST" action="{{ url('/addCita') }}">
                {{csrf_field()}}
                  <div class="card">
                    <div class="card-header">
                      Registro de consulta
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de próxima cita</label>
                            <input type="date" class="form-control" id="proximaConsulta" name="proximaConsulta" placeholder="Fecha de proxima cita" required>
                        </div>
                    </div>
                    <div class="card-footer">
                      <input type="text" name="idConsulta" value="{{$consulta}}">
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