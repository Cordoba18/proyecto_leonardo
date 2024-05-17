<?php

namespace App\Http\Controllers;

use App\Models\Gasto_y_ingreso;
use App\Models\Tarjeta;
use App\Models\Tipo_dineros;
use App\Models\Tipo_periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastosIngresosController extends Controller
{
    //

    public function index(){

        $tipos_periodos = Tipo_periodo::all();
        $tipos_dineros = Tipo_dineros::all();

        $usuario = Auth::user();
        $tarjetas = Tarjeta::join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_tarjetas", "tarjetas.id_tipo_tarjeta","tipos_tarjetas.id")
        ->select("tarjetas.id", "tarjetas.numero", "tarjetas.nombre_banco", "asociaciones_tarjetas.asociacion","tipos_tarjetas.tipo" )
        ->where("tarjetas.id_usuario", '=', $usuario->id)
        ->where("tarjetas.id_estado", '=', 1)
        ->get();

        $fechaActual = Carbon::now();

        // Obtener el primer día del mes
        $primerDiaDelMes = $fechaActual->firstOfMonth();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoPrimerDiaDelMes = $primerDiaDelMes->format('Y-m-d');

        $ultimoDiaDelMes = $fechaActual->lastOfMonth();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoUltimoDiaDelMes = $ultimoDiaDelMes->format('Y-m-d');


        return view('gastos_ingresos.create',compact('tipos_periodos','tipos_dineros','tarjetas','formatoPrimerDiaDelMes', 'formatoUltimoDiaDelMes'));

    }

    public function save(Request $request){

        $new_gastos_ingresos = new Gasto_y_ingreso();
        $new_gastos_ingresos->detalle = $request->detalle;
        $new_gastos_ingresos->valor = $request->valor;
        $new_gastos_ingresos->fecha = $request->fecha;
        $new_gastos_ingresos->id_tipo_periodo = $request->tipo_periodo;
        $new_gastos_ingresos->id_tarjeta = $request->tarjeta;
        $new_gastos_ingresos->id_tipo_dinero = $request->tipo_dinero;
        $new_gastos_ingresos->id_estado = 1;

        $new_gastos_ingresos->save();

        return redirect()->route('movimientos_usuario')->with('message', 'Se agrego con exito!');

    }


    public function delete(Request $request){

        $new_gastos_ingresos = Gasto_y_ingreso::find($request->id_gasto_ingreso);
        $new_gastos_ingresos->id_estado = 2;
        $new_gastos_ingresos->save();

        return redirect()->route('movimientos_usuario')->with('message', 'Se elimino con exito!');

    }
}
