@extends('plantilla')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pacientes registrados</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de perfiles</h3>
                    <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input id="barra" type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="buscar()">
                        <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table id="table" class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                        <th>NO. DE EXPEDIENTE</th>
                        <th>NOMBRE DEL PACIENTE</th>
                        <th>NOMBRE DEL DUEÑO</th>
                        <th>TELÉFONO</th>
                        <th>EDAD</th>
                        <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mascotas as $mascota)
                    @if($mascota->estatusExpediente == 1)
                    <tr>
                        <td>{{$mascota->idExpediente}}</td>
                        <td>{{$mascota->nombreExpediente}}</td>
                        <td>{{$mascota->dueñoExpediente}}</td>
                        <td>{{$mascota->telefonoExpediente}}</td>
                        <td>{{$mascota->edadExpediente}}</td>
                        <td>
                            <form method="post" action="{{ url('/getProfile')}}" style="display:inline">
                                {{csrf_field()}}
                                <input type="hidden" name="idExpediente" value="{{$mascota->idExpediente}}"/>
                                <button type="submit" name="Ver" class="btn btn-info">Ver</button>
                            </form>
                            <a href="#"  class="btn btn-danger" data-toggle="modal" data-target="#eliminar{{$mascota->idExpediente}}">Eliminar</a>   
                        </td>
                    </tr>
                    @include('modulos.modalEliminar')
                    @endif
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="center-block">
                    {{$mascotas->links()}}
                </div>
            </div>
            </div>
    </section>
</div>

@endsection