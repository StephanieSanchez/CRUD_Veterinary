@extends('plantilla')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Historico de consultas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <h3 class="card-title">Lista de consultas</h3><br>
                    <p>Especifique la fecha de la consulta que quiere mostrar</p>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="POST" action="{{ url('/getConsultas') }}">
                                {{csrf_field()}}
                                    <input type="radio" id="opcFecha" name="opcFecha" value="0" onclick="activarFecha(this)" /> Por fecha<br>
                                    <input type="date" id="fecha" name="fecha" required disabled /><br>
                                    <input type="radio" id="opcFecha" name="opcFecha" value="1" onclick="activarFecha(this)" /> Rango de fecha<br>
                                    De <input type="date" id="fecha1" name="fecha1" required disabled> A <input type="date" id="fecha2" name="fecha2" required disabled><br>
                                    <input type="submit" value="Buscar" class="btn btn-info">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <form role="form" action="{{ url('/getPdf') }}" method="POST">
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        @isset($fechas)
                            @isset($fechas->fecha2)
                                <h3>DEL {{$fechas->fecha1}} AL {{$fechas->fecha2}}</h3>
                                <input type="hidden" name="fecha1" value="{{$fechas->fecha1}}"/>
                                <input type="hidden" name="fecha2" value="{{$fechas->fecha2}}"/>
                            @endisset
                            @isset($fechas->fecha)
                                <h3>DEL {{$fechas->fecha}}</h3>
                                <input type="hidden" name="fecha" value="{{$fechas->fecha}}"/>
                            @endisset
                        @endisset
                        <br>
                        <table id="table" class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                            <th>NUMERO</th>
                            <th>CLAVE CONSULTA</th>
                            <th>FECHA CONSULTA</th>
                            <th>DOCTOR</th>
                            <th>PACIENTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($consultas)
                                @foreach($consultas as $consulta)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$consulta->idConsulta}}</td>
                                        <td>{{$consulta->fechaConsulta}}</td>
                                        <td>{{$consulta->doctorConsulta}}</td>
                                        <td>{{$consulta->nombreExpediente}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        </table>
                        <row>

                        </row>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    @isset($fechasConsultas)
                        <input type="button" value="Generar gráficas por fechas" class="btn btn-success" onclick="pintarChart({{ json_encode($fechasConsultas,TRUE) }})" />
                        <input type="hidden" name="fechasConsulta" value="{{ json_encode($consultas,TRUE) }}"/>
                        
                        <input type="button" value="Generar gráficas por tipo de paciente" class="btn btn-success" onclick="pintarChart3({{ json_encode($animales,TRUE) }})" />
                    @endisset
                </div>
                </div>
                <!-- /.card -->
                @isset($consultas)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="myChart3" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        {{csrf_field()}}
                        <div class="card-footer">
                                <input type="submit" value="Generar reporte PDF" class="btn btn-success"/>
                        </div>  
                    </div>
                </form>
                @endisset
            </div>
            </div>
    </section>
</div>

@endsection