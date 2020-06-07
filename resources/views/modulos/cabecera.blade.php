 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        Sesion del usuario:{{session('Usuario')}} <br>
        Ultima visita a la página el {{{Cookie::get('conexionAnterior')}}}
        
      </li>
    </ul>

    

    <!-- Right navbar links -->
    
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Informacion de perfil</span>
          <div class="dropdown-divider"></div>
            <i class="fas fa-envelope mr-2"></i> 
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->