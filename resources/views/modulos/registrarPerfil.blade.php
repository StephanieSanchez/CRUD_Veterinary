@extends('plantilla')
@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de pacientes</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
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
                    @php $id = ''; $name = ''; $age = ''; $nameOwner = ''; $phone = ''; $address = ''; $petName = ''; $raceName = ''; @endphp
                    @if(isset($profile)) 
                        @php
                            $name = $profile->nombreExpediente;
                            $age = $profile->edadExpediente;
                            $nameOwner = $profile->dueñoExpediente; 
                            $phone = $profile->telefonoExpediente; 
                            $address = $profile->direccionExpediente;
                            $petName = $profile->nombreMascota;
                            $raceName = $profile->nombreRaza;
                            $id = $profile->idExpediente;
                        @endphp
                    @endif
                    @if(isset($profile)) 
                        <form role="form" method="POST" action = "{{ url('/updateProfile') }}">
                    @endif
                    @if(!isset($profile)) 
                        <form role="form" method="POST" action = "{{ url('/addProfile') }}">
                    @endif
                        {{csrf_field()}}
                        <input type="hidden" name="idExpediente" value="{{$id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre del paciente</label>
                                <input type="text" value="{{$name}}" class="form-control" id="nombreExpediente" name="nombreExpediente" placeholder="Ingrese el nombre del paciente"  required >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Edad del paciente</label>
                                <input type="text" value="{{$age}}" class="form-control" id="edadExpediente" name="edadExpediente" placeholder="Ingrese la edad del paciente"  required >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre del dueño</label>
                                <input type="text" value="{{$nameOwner}}" class="form-control" id="dueñoExpediente" name="dueñoExpediente" placeholder="Ingrese el nombre del dueño del paciente"  required >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teléfono</label>
                                <input type="text" value="{{$phone}}" class="form-control" id="telefonoExpediente" name="telefonoExpediente" placeholder="Ingrese el teléfono"  required >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dirección</label>
                                <input type="text" value="{{$address}}" class="form-control" id="direccionExpediente" name="direccionExpediente" placeholder="Ingrese la dirección"  required >
                            </div>
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Datos adicionales de la mascota
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Mascota</label>
                                                        <p>Seleccione una opción existente</p>
                                                        <select id="idMascota" name="idMascota" class="form-control" onchange="activarOpcion(this)">
                                                            <option disabled selected>--Seleccione una opción--</option>
                                                            <option value="0">Registrar otro</option>
                                                            @foreach($mascotas as $mascota)
                                                                @php
                                                                    $checked = '';
                                                                @endphp
                                                                @if($petName == $mascota->nombreMascota)
                                                                    @php $checked = 'selected'; @endphp
                                                                @endif
                                                                <option value="{{$mascota->idMascota}}" {{$checked}}>{{$mascota->nombreMascota}} | {{$mascota->tipoMascota}}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <p>Registre el dato si no lo encuentra en el catalogo</p>
                                                        <input type="text" class="form-control" id="nombreMascota" name="nombreMascota" placeholder="p. ej. perro, gato, etc." disabled>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tipo de mascota</label>
                                                        <p>Registre el dato si no lo encuentra en el catalogo<p>
                                                        <input type="text" class="form-control" id="tipoMascota" name="tipoMascota" placeholder="p. ej. mamifero, reptíl, etc." disabled>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Datos adicionales de la raza
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre de la raza</label>
                                                <p>Seleccione una opción existente</p>
                                                <select name="idRaza" class="form-control" onchange="activarOpcionRaza(this)">
                                                    <option disabled selected>--Seleccione una opción--</option>
                                                    <option value="0">Registrar otro</option>
                                                    @foreach($razas as $raza)
                                                        @php
                                                            $checked = '';
                                                        @endphp
                                                        @if($raceName == $raza->nombreRaza)
                                                            @php $checked = 'selected'; @endphp
                                                        @endif
                                                        <option value="{{$raza->idRaza}}" {{$checked}}>{{$raza->nombreRaza}}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <p>Registre el dato si no lo encuentra en el catalogo</p>
                                                <input type="text" class="form-control" id="nombreRaza" name="nombreRaza" placeholder="p. ej. pastor aleman, guppy, etc." disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Datos del usuario</h3>
                            </div>
                            <p>El usuario registrado tendrá acceso al sistema para consultar datos de su mascota</p>
                            <input type="checkbox" name="usuarioExiste"/> Buscar usuario ya registrado
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de usuario</label>
                                <input type="text" class="form-control" id="nombreUsusario" name="nombreUsusario" placeholder="Ingrese el nombre de usuario"  required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contraseña</label>
                                <input type="password" class="form-control" id="contraseñaUsusario" name="contraseñaUsusario" placeholder="Ingrese la contraseña"  required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            @php
                                $type = 'Registrar';
                            @endphp
                            @if(isset($profile))
                                @php $type = 'Actualizar'; @endphp
                            @endif
                            <input type="submit" class="btn btn-primary" value="{{$type}}" />
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