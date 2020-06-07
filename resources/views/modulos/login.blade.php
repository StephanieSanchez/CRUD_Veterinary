@extends('plantilla')
@section('login')
<div class="hold-transition login-page">
<div class="login-box">
  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicio de Sesion</p><br>
    
      <form method="post" action="{{url('/consult')}}">
      {{csrf_field()}}
        <div class="input-group mb-3">
          <label for="nombre">{{'correo'}}</label>
        <input type="email" class="form-control" placeholder="Email" name="correo" required value="{{Cookie::get('usuarioRecordado')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <label for="password">{{'password'}}</label>
          <input type="password" class="form-control" placeholder="Password" name="password" required value="{{Cookie::get('passRecordado')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
           
            <input type="checkbox" name="recordarme" > {{'recordame'}} en este equipo</input>
          </div>
          <!-- /.col -->
        </div>  

      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection