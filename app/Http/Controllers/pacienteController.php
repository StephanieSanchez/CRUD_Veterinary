<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paciente;
use App\mascota;
use App\raza;
use App\usuario;
use Illuminate\Support\Facades\DB;

class pacienteController extends Controller
{
    //
    function createProfile(Request $request){
        if($request->idExpediente){
            updateProfile($request);
        }
        $campos=[
            'nombreExpediente' => 'required',
            'edadExpediente' => 'required',
            'dueñoExpediente' => 'required',
            'telefonoExpediente' => 'required|integer',
            'direccionExpediente' => 'required',
            'nombreUsusario' => 'required|unique:usuario',
            'contraseñaUsusario' => 'required'
        ];
        $mensaje = ["required" => 'El atributo :attribute es requerido',
                    "integer" => 'El atributo :attribute debe ser de tipo entero',
                    "string" => 'El atributo :attribute debe tener un valor valido al dato que se pide',
                    "unique" => 'El atributo :attribute tiene un valor ya existente'];
        $this->validate($request, $campos, $mensaje);
        try{
            $usuario = new usuario;
            $raza = new raza;
            $mascota = new mascota;
            $paciente = new paciente;
            $usuario -> nombreUsusario = $request -> nombreUsusario;
            $usuario -> contraseñaUsusario = $request -> contraseñaUsusario;
            $usuario -> tipoUsuario = 3;
            $usuario -> save();
            $idUsuario = DB::getPdo()->lastInsertId();
            if($request -> idMascota == 0){
                $mascota -> nombreMascota = $request -> nombreMascota;
                $mascota -> tipoMascota = $request -> tipoMascota;
                $mascota -> save();
                $idMascota = DB::getPdo()->lastInsertId();
            }else{
                $idMascota = $request -> idMascota;
            }
            if($request -> idRaza == 0){
                $raza -> nombreRaza = $request -> nombreRaza;
                $raza -> idMascota = $idMascota;
                $raza -> save();
                $idRaza = DB::getPdo()->lastInsertId();
            }else{
                $idRaza = $request -> idRaza;
            }
            $now = new \DateTime();
            $paciente -> nombreExpediente = $request -> nombreExpediente;
            $paciente -> edadExpediente = $request -> edadExpediente;
            $paciente -> dueñoExpediente = $request -> dueñoExpediente;
            $paciente -> telefonoExpediente = $request -> telefonoExpediente;
            $paciente -> direccionExpediente = $request -> direccionExpediente;
            $paciente -> fechaExpediente = $now->format('Y-m-d');;
            $paciente -> idRaza = $idRaza;
            $paciente -> idMascota = $idMascota;
            $paciente -> idUsuario = $idUsuario;
            $paciente -> save();
            alert()->success('Se ha registrado el perfil', '¡Exito!');
            return redirect('/createProfile');
        }catch(\Exception $e){
            alert()->warning('No se registro el perfil', '¡Error!');
            return redirect('/createProfile');
        }
    }

    function getView(){
        $sql = 'SELECT * FROM mascota';
        $mascotas = DB::select($sql);
        $sql = 'SELECT * FROM raza';
        $razas = DB::select($sql);
        return view('modulos.registrarPerfil')->with('mascotas', $mascotas)->with('razas', $razas);
    }

    function getProfiles(){
        $datos['mascotas'] = paciente::paginate(10);
        return view('modulos.listaPerfiles', $datos);
    }

    function getProfile(Request $request){
        $sql = "SELECT * FROM expediente as ex join mascota as ma on ex.idMascota = ma.idMascota join raza as ra on ex.idRaza = ra.idRaza WHERE idExpediente = ".$request->idExpediente;
        $profile = DB::select($sql);
        //var_dump($profile->;
        $sql = 'SELECT * FROM mascota';
        $mascotas = DB::select($sql);
        $sql = 'SELECT * FROM raza';
        $razas = DB::select($sql);
        return view('modulos.registrarPerfil', ['profile' => $profile[0]])->with('mascotas', $mascotas)->with('razas', $razas);
    }

    function updateProfile(Request $request){
        $keys = '_token';
        $datos = request()->except($keys);
        paciente::where('idExpediente', '=', $request -> idExpediente)->update($datos);
        return redirect('/listaPerfiles');
    }
    function deleteProfile(Request $request){
        $keys = '_token';
        $datos = request()->except($keys);
        paciente::where('idExpediente', '=', $request -> idExpediente)->update($datos);
        alert()->success('El paciente se ha dado de baja', '¡Exito!');
        return redirect('/listaPerfiles');
    }
}
