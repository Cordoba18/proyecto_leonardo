<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Asociacion_tarjeta;
use App\Models\Tarjeta;
use App\Models\Tipo_tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarjetasController extends Controller
{
    //

    public function index(){
        $usuario = Auth::user();
        $tarjetas = Tarjeta::join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_tarjetas", "tarjetas.id_tipo_tarjeta","tipos_tarjetas.id")
        ->select("tarjetas.id", "tarjetas.numero", "tarjetas.cuota_manejo", "tarjetas.fecha_cuota_manejo", "tarjetas.nombre_banco", "asociaciones_tarjetas.asociacion","tipos_tarjetas.tipo" )
        ->where("tarjetas.id_usuario", '=', $usuario->id)
        ->where("tarjetas.id_estado", '=', 1)
        ->get();
        return view('tarjetas.show',compact("tarjetas"));
    }


    public function create(Request $request){
        $fechaActual = Carbon::now();

        // Obtener el primer día del mes
        $primerDiaDelMes = $fechaActual->firstOfMonth();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoPrimerDiaDelMes = $primerDiaDelMes->format('Y-m-d');

        $ultimoDiaDelMes = $fechaActual->lastOfMonth();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoUltimoDiaDelMes = $ultimoDiaDelMes->format('Y-m-d');

        $tipos_tarjetas = Tipo_tarjeta::all();
        $asociaciones = Asociacion_tarjeta::all();
        return view('tarjetas.create',compact('tipos_tarjetas', 'asociaciones','formatoPrimerDiaDelMes', 'formatoUltimoDiaDelMes'));
    }





    public function save(Request $request){

        $usuario = Auth::user();
       $validacion_tarjeta = Tarjeta::where("numero", "=", $request->numero_tarjeta)->where("id_usuario", "=", $usuario->id)->first();

       if ($validacion_tarjeta) {
        return redirect()->route('tarjetas.crear')->with('message_error','La tarjeta del usuario ya existe');
       }else{

        $new_tarjeta = new Tarjeta();

        $new_tarjeta->numero = $request->numero_tarjeta;
        $new_tarjeta->id_tipo_tarjeta = $request->tipo_tarjeta;
        $new_tarjeta->id_asociacion_tarjeta = $request->tipo_asociacion;
        if ($request->cuota_manejo) {
            $new_tarjeta->cuota_manejo = $request->cuota_manejo;
            $new_tarjeta->fecha_cuota_manejo = $request->fecha_cuota_manejo;
        }
        $new_tarjeta->nombre_banco = $request->nombre_banco;
        $new_tarjeta->id_usuario = $usuario->id;

$new_tarjeta->id_estado = 1;
 if ($new_tarjeta->save()) {
    return redirect()->route('tarjetas.crear')->with('message','La tarjeta fue creada correctamente!');
 }else{
    return redirect()->route('tarjetas.crear')->with('message_error','Tarjeta no guardada!');
 }





       }
    }
    public function delete(Request $request){

      $tarjeta = Tarjeta::find($request->id_tarjeta);
      $tarjeta->id_estado = 2;

      $tarjeta->save();

      return redirect()->route('tarjetas')->with('message','Tarjeta eliminada con exito!');
    }


}


