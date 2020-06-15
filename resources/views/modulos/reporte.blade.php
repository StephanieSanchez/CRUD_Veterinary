<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
<!-- AdminLTE App -->
<script src="js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<link rel="stylesheet" href="css/sweetalert.css">
<script src="js/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/fontello.css">
<link rel="stylesheet" href="css/estilos.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="card">
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
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
                @isset($res)
                   @foreach($res as $consulta)
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
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
