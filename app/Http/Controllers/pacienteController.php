<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paciente;
use App\mascota;
use App\raza;
use App\usuario;
use Illuminate\Support\Facades\DB;
use PDO;

class pacienteController extends Controller
{
    //
    function createProfile(Request $request){
        $campos=[
            'nombreExpediente' => 'required',
            'edadExpediente' => 'required',
            'dueñoExpediente' => 'required',
            'telefonoExpediente' => 'required|integer',
            'direccionExpediente' => 'required',
            'nombreUsusario' => 'required',
            'contraseñaUsusario' => 'required'
        ];
        $mensaje = ["required" => 'El atributo :attribute es requerido',
                    "integer" => 'El atributo :attribute debe ser de tipo entero',
                    "string" => 'El atributo :attribute debe tener un valor valido al dato que se pide',
                    "unique" => 'El atributo :attribute tiene un valor ya existente'];
        $this->validate($request, $campos, $mensaje);
        $usuario = new usuario;
        $raza = new raza;
        $mascota = new mascota;
        $paciente = new paciente;
        try{
            if(isset($request->usuarioExiste)){
                $sql = 'SELECT * FROM usuario WHERE nombreUsusario="'.$request -> nombreUsusario.'" AND contraseñaUsusario="'.$request -> contraseñaUsusario.'"';
                $usuario = DB::table('usuario')->select('idUsuario')
                            ->where("nombreUsusario","=",$request->nombreUsusario)
                            ->where("contraseñaUsusario","=",$request->contraseñaUsusario)
                            ->take(1)->get();
                $res = $usuario->first();
                
                    $idUsuario = $res->idUsuario;
            }else{
                $usuario -> nombreUsusario = $request -> nombreUsusario;
                $usuario -> contraseñaUsusario = $request -> contraseñaUsusario;
                $usuario -> tipoUsuario = 3;
                $usuario -> save();
                $idUsuario = DB::getPdo()->lastInsertId();
            }
            try{
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
                $paciente -> fechaExpediente = $now->format('Y-m-d');
                $paciente -> estatusExpediente = 1;
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
        }catch(\Exception $e){
            alert()->warning('No se pudo consultar el usuario', '¡Error!');
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
        $sql = "UPDATE expediente SET nombreExpediente = '".$request->nombreExpediente."', edadExpediente = '".$request->edadExpediente."', dueñoExpediente = '".$request->dueñoExpediente."', telefonoExpediente = '".$request->telefonoExpediente."', direccionExpediente = '".$request->direccionExpediente."', idMascota = ".$request->idMascota.", idRaza = ".$request->idRaza." WHERE idExpediente = ".$request->idExpediente;
        DB::update($sql);
        return redirect('/listaPerfiles');
    }
    function deleteProfile(Request $request){
        $keys = '_token';
        $datos = request()->except($keys);
        paciente::where('idExpediente', '=', $request -> idExpediente)->update($datos);
        alert()->success('El paciente se ha dado de baja', '¡Exito!');
        return redirect('/listaPerfiles');
    }

    function getRecords(Request $request){
        $sql = "SELECT * FROM expediente WHERE idExpediente LIKE '".$request->keyExpediente."%' OR nombreExpediente LIKE '".$request->keyExpediente."%' OR dueñoExpediente LIKE '".$request->keyExpediente."%'";
        $records = DB::select($sql);
        return view('modulos.registrarConsulta', ['records' => $records]);
    }

    function getRecord(Request $request){
        $sql = "SELECT * FROM expediente as ex join mascota as ma on ex.idMascota = ma.idMascota join raza as ra on ex.idRaza = ra.idRaza WHERE ex.idExpediente = ".$request->idExpediente;
        $record = DB::select($sql);

        $sqlConsultation = "SELECT * FROM expediente as ex  JOIN consulta as co on ex.idExpediente = co.idExpediente  JOIN renglonconsulta as rc on co.idConsulta = rc.idConsulta WHERE ex.idExpediente = ".$request->idExpediente;
        $consultations = DB::select($sqlConsultation);
        $rows = array();
        foreach($consultations as $consultation){
            $sqlRow = "SELECT * FROM  consulta as co JOIN renglonconsulta as rc on co.idConsulta = rc.idConsulta WHERE co.idConsulta = ".$consultation->idConsulta;
            $row = DB::select($sqlRow);
            $obj = new \stdClass;
            $obj->number = $consultation->idConsulta;
            $obj->date = $consultation->fechaConsulta;
            $obj->doctor = $consultation->doctorConsulta;
            $obj->rows = $row;
            $rows[] = $obj;
        }
        //echo "<pre>"; var_dump($rows); echo "</pre>";
        return view('modulos.registrarConsulta', ['recordEx' => $record[0], 'consultations' => $rows]);
    }
}
