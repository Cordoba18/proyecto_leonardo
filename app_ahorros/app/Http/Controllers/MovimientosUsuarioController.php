<?php

namespace App\Http\Controllers;

use App\Models\Gasto_y_ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimientosUsuarioController extends Controller
{
    public function index(){

        $usuario = Auth::user();

        $gastos_ingresos = Gasto_y_ingreso::join("tarjetas","gastos_y_ingresos.id_tarjeta","tarjetas.id")
        ->join("tipos_tarjetas","tarjetas.id_tipo_tarjeta", "tipos_tarjetas.id")
        ->join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_periodos","gastos_y_ingresos.id_tipo_periodo","tipos_periodos.id")
        ->join("tipos_dineros","gastos_y_ingresos.id_tipo_dinero","tipos_dineros.id")
        ->select("asociaciones_tarjetas.asociacion", "tipos_tarjetas.tipo as tipo_tarjeta", "tarjetas.numero", "tarjetas.nombre_banco", "gastos_y_ingresos.detalle", "gastos_y_ingresos.valor", "gastos_y_ingresos.fecha", "tipos_periodos.periodo", "tipos_periodos.id as id_tipo_periodo","tipos_dineros.tipo as tipo_dinero", "gastos_y_ingresos.id_tipo_dinero", "gastos_y_ingresos.id")
        ->where("tarjetas.id_estado","=", 1)
        ->where("gastos_y_ingresos.id_estado","=", 1)
        ->where("tarjetas.id_usuario","=",$usuario->id )
        ->get();
        return view('movimientos_usuario.show',compact("gastos_ingresos"));
    }
}
