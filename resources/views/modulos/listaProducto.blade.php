@extends('plantilla')
@section('content')
@if($errors->has('cantidad'))
    <script>
    swal({
        title: "Espere",
        text: "Ocurrio un error al resurtir, verifique que la cantidad sea entera y mayor a cero",
        type: "warning",
        confirmButtonText: "Cerrar",
        closeOnConfirm: false
    });
    </script>
@endif

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos disponibles</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de articulos</h3>
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
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>PRECIO</th>
                        <th>EXISTENCIA</th>
                        <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($accesorios as $accesorio)
                    @if($accesorio->estatus_acc == 1)
                    <tr>
                        <td>{{$accesorio->clave_acc}}</td>
                        <td>{{$accesorio->nombre_acc}}</td>
                        <td>{{$accesorio->desc_acc}}</td>
                        <td>{{$accesorio->precio_acc}}</td>
                        <td>{{$accesorio->existencia}}</td>
                        <td>
                            <form method="post" action="{{ url('/get') }}" style="display:inline">
                                {{csrf_field()}}
                                <input type="hidden" name="clave_acc" value="{{$accesorio->clave_acc}}"/>
                                <button type="submit" name="Ver" class="btn btn-info">Ver</button>
                            </form>
                            <a href="#"  class="btn btn-warning" data-toggle="modal" data-target="#resurtir{{$accesorio->clave_acc}}">Resurtir</a>
                            <a href="#"  class="btn btn-danger" data-toggle="modal" data-target="#eliminar{{$accesorio->clave_acc}}">Eliminar</a>   
                        </td>
                    </tr>
                    @include('modulos.modalResurtir')
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
                    {{$accesorios->links()}}
                </div>
            </div>
            </div>
    </section>
</div>

@endsection