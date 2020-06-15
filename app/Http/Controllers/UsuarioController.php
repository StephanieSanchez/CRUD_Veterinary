<?php

namespace App\Http\Controllers;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Cookie;

class UsuarioController extends Controller
{
    //
    public function consult(Request $request)
    {
        //
        $datos = request()->all();
        $keys = '_token';
        $cooki = 'cookie';
        $datos = request()->except($keys);
        $datos = request()->except($cooki);
        $nombre = $request->input("nom");

        $tipoUsu = DB::table('usuario')
        ->where('nombreUsusario', $request->input("nom"))
        ->where('contraseñaUsusario', $request->input("password"))
        ->value('tipoUsuario');

        $resultado = DB::table('usuario')
            ->where('nombreUsusario', $request->input("nom"))
            ->where('contraseñaUsusario', $request->input("password"))
            ->value('nombreUsusario');
        if ($resultado == null) {
            alert("El correo o la contrasena no Existen");
            return view(('modulos.login'));
          
        } else {
           
            session(['tipoUsuario' => $tipoUsu]);
            session(['Usuario' => $resultado]);
            if ($request->input("recordarme") == true) {
                Cookie::queue('usuarioRecordado', $request->input("nom"));
                Cookie::queue('passRecordado', $request->input("password"));
                Cookie::queue('conexionAnterior', date('Y-m-d H:i:s'));
                Cookie::queue('conexionNueva', date('Y-m-d H:i:s'));
                return Redirect::to('/inicio');
            } else {

                Cookie::queue('conexionAnterior', Cookie::get('conexionNueva'));
                Cookie::queue('conexionNueva', date('Y-m-d H:i:s'));

                return Redirect::to('/inicio');
            }
        }
    }
    public function salir()
    {
        session()->forget('Usuario');

        return Redirect::to('/');
    }

    public function borrarCookie()
    {
        \Cookie::queue(\Cookie::forget('usuarioRecordado'));
        \Cookie::queue(\Cookie::forget('passRecordado'));
        \Cookie::queue(\Cookie::forget('conexionAnterior'));
        \Cookie::queue(\Cookie::forget('conexionNueva'));
        session()->forget('Usuario');
        // Cookie::forget('passRecordado');
        // Cookie::flush();
        return Redirect::to('/');
    }
}
