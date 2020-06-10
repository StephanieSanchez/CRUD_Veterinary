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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!-- jQuery -->
<script src="jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
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

<body class="hold-transition sidebar-mini layout-fixed" onload="pintarFecha()">

  @include('modulos.cabecera')
  @include('modulos.lateral')

<main>

  @yield('content')
</main>
  @include('modulos.pie')
 

  <script type="text/javascript">
      function buscar() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("barra");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td0 = tr[i].getElementsByTagName("td")[0];
          td1 = tr[i].getElementsByTagName("td")[1];
          td2 = tr[i].getElementsByTagName("td")[2];
          td3 = tr[i].getElementsByTagName("td")[3];
          td4 = tr[i].getElementsByTagName("td")[4];
          if (td0 || td1 || td2 || td3 || td4) {
            txtValue0 = td0.textContent || td0.innerText;
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            txtValue3 = td3.textContent || td3.innerText;
            txtValue4 = td4.textContent || td4.innerText;
            if ((txtValue0.toUpperCase().indexOf(filter) > -1) || (txtValue1.toUpperCase().indexOf(filter) > -1) ||
            (txtValue2.toUpperCase().indexOf(filter) > -1) || (txtValue3.toUpperCase().indexOf(filter) > -1) || 
            (txtValue4.toUpperCase().indexOf(filter) > -1)) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }


      
  </script>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- jQuery -->
  <script src="jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="js/demo.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/scripts.js"></script>
<script>
window.onpageshow = function(evt) { 
    // If persisted then it is in the page cache, force a reload of the page. 
    if (evt.persisted) { 
     document.body.style.display = "none"; 
    
     location.reload(); 
    } 
}; 
window.addEventListener("pageshow", function (event) { 
    var historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2); 
    if (historyTraversal) { 
    // Handle page restore. 
    window.location.reload(); 
    } 
}); 

</script>
<script>
function pintarFecha()
{
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var f=new Date();
fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
document.getElementById('etiqueta_fecha').innerHTML=fecha;
}
</script>
<script>
  function activarOpcion(op){
    var opc = op.value;
    switch(opc){
      case '0':
        document.getElementById("nombreMascota").disabled = false;
        document.getElementById("tipoMascota").disabled = false;
      break;
      default:
        document.getElementById("nombreMascota").disabled = true;
        document.getElementById("tipoMascota").disabled = true;
      break;
    }
  }
</script>
<script>
  function activarOpcionRaza(op){
    var opc = op.value;
    switch(opc){
      case '0':
        document.getElementById("nombreRaza").disabled = false;
      break;
      default:
        document.getElementById("nombreRaza").disabled = true;
      break;
    }
  }
</script>
<script>
  function camposUsuarios(){
    document.getElementById("contraseñaUsusario").disabled = !document.getElementById("contraseñaUsusario").disabled;
  }
</script>
<script>
  function activarFecha(op){
    var opc = op.value;
    switch(opc){
      case '0':
        document.getElementById("fecha").disabled = false;
        document.getElementById("fecha1").disabled = true;
        document.getElementById("fecha2").disabled = true;
      break;
      case '1':
      document.getElementById("fecha").disabled = true;
      document.getElementById("fecha1").disabled = false;
      document.getElementById("fecha2").disabled = false;
      break;
      default:
      break;
    }
  }
</script>
<script>
  function pintarChart(datos){
    var labelsArray = [];
    var dataArray = [];
    for(var i in datos)
      labelsArray.push(datos[i]["fechaConsulta"]);
      
    for(var j in datos)
      dataArray.push(datos[j]["total"]);

    console.info(dataArray);

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsArray,
            datasets: [{
                label: '# of Votes',
                data: dataArray,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
  }
</script>
  @include('sweet::alert')
</body>
</html>
