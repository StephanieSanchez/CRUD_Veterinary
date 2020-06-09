<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paciente;
use App\mascota;
use App\raza;
use App\usuario;
use App\consulta;
use App\renglonconsulta;
use Illuminate\Support\Facades\DB;
class consultaController extends Controller
{
    function addConsult(Request $request){
        $campos=[
            'idExpediente' => 'required',
            'descripcionRenglonConsulta' => 'required',
            'doctorConsulta' => 'required'
        ];
        $mensaje = ["required" => 'El atributo :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);
        $consulta = new consulta;
        $renglonconsulta = new renglonconsulta;
        try{
            $now = new \DateTime();
            $consulta->fechaConsulta = $now->format('Y-m-d');
            $consulta->doctorConsulta = $request->doctorConsulta;
            $consulta->proximaConsulta = $request->proximaConsulta;
            $consulta->idExpediente = $request->idExpediente;
            $consulta->save();
            $idConsulta = DB::getPdo()->lastInsertId();
            $renglonconsulta -> descripcionRenglonConsulta = $request->descripcionRenglonConsulta;
            $renglonconsulta -> idConsulta = $idConsulta;
            $renglonconsulta->save();
            alert()->success('Se ha registrado la consulta', '¡Exito!');
            return redirect('/createConsult');
        }catch(\Exception $e){
            alert()->warning('Ocurrio un error al registrar la consulta', '¡Error!');
            return redirect('/createConsult');
        }
    }
    function getRecordsCita(Request $request){
        $sql = "SELECT * FROM expediente WHERE idExpediente LIKE '".$request->keyExpediente."%' OR nombreExpediente LIKE '".$request->keyExpediente."%' OR dueñoExpediente LIKE '".$request->keyExpediente."%'";
        $records = DB::select($sql);
        return view('modulos.registrarCita', ['records' => $records]);
    }

    function getRecordCita(Request $request){
        $sql = "SELECT * FROM expediente as ex join mascota as ma on ex.idMascota = ma.idMascota join raza as ra on ex.idRaza = ra.idRaza WHERE ex.idExpediente = ".$request->idExpediente;
        $record = DB::select($sql);

        $sqlConsultation = "SELECT * FROM expediente as ex JOIN consulta as co on ex.idExpediente = co.idExpediente JOIN renglonconsulta as rc on co.idConsulta = rc.idConsulta WHERE ex.idExpediente = ".$request->idExpediente." AND fechaConsulta = (SELECT MAX(fechaConsulta) FROM consulta WHERE idExpediente=".$request->idExpediente.") ";
        $consultations = DB::select($sqlConsultation);
        
        //echo "<pre>"; var_dump($rows); echo "</pre>";
        return view('modulos.registrarCita', ['recordEx' => $record[0]])->with('consultas', $consultations);
        //return $consultations;
    }

    function addCita(Request $request){
        $campos=[
            'idConsulta' => 'required',
            'proximaConsulta' => 'required'
        ];
        $mensaje = ["required" => 'El atributo :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);
        $consulta = new consulta;
        try{
            $sql = "UPDATE consulta  SET proximaConsulta = '".$request->proximaConsulta."' WHERE idConsulta = ".$request->idConsulta;
            DB::update($sql);
            alert()->success('Se ha registrado la cita para '. $request->proximaConsulta, '¡Exito!');
            return redirect('/createCita');
        }catch(\Exception $e){
            alert()->warning('Ocurrio un error al registrar la cita', '¡Error!');
            return redirect('/createCita');
        }
    }

    function updateCita(Request $request){
        $campos=[
            'proximaConsulta' => 'required'
        ];
        $mensaje = ["required" => 'El atributo :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);
        $sql = "UPDATE consulta SET proximaConsulta = '".$request->proximaConsulta."' WHERE idConsulta=".$request->idConsulta;
        DB::update($sql);
        alert()->success('Se ha reagendado la cita para: '. $request->proximaConsulta, '¡Exito!');
        return redirect('/inicio');
    }
}
