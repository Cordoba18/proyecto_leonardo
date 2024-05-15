<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //

    public function index(){
        return view('usuario.registro');
    }


    public function register(Request $request){

        if (User::where("email","=", $request->email)->first()) {
            return redirect()->route('registro')->with('message_error', 'Ya existe un usuario con ese email electronico!');
        }else if ($request->password !=  $request->password2) {
            return redirect()->route('registro')->with('message_error', 'Las contraseñas no coinciden!');
        }else{


            $new_usuario = new User();
            $new_usuario->nombres = $request->nombres;
            $new_usuario->apellidos = $request->apellidos;
            $new_usuario->numero_de_identificacion	 = $request->numero_de_identificacion	;
            $new_usuario->email = $request->email;
            $new_usuario->password =  Hash::make($request->password);

            $new_usuario->save();

                 //generamos la session
                 request()->session()->regenerate();
                 //generamos el reporte

                 return redirect()->route('inicio')->with('message', "Bienvenido $new_usuario->nombres!");


        }

     }
}
