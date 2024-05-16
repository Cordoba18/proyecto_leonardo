<?php

namespace App\Http\Controllers;

use App\Models\Gasto_y_ingreso;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class InicioController extends Controller
{


    public function index(){

        Carbon::setLocale('es');

        $usuario = Auth::user();
        $zonaHorariaColombia = new DateTimeZone('America/Bogota');
        $fechaActual = Carbon::now($zonaHorariaColombia)->format('Y-m-d');

        $gastos_ingresos = Gasto_y_ingreso::join("tarjetas", "gastos_y_ingresos.id_tarjeta","tarjetas.id")
        ->select("tarjetas.cuota_manejo", "gastos_y_ingresos.valor", "gastos_y_ingresos.id_tipo_periodo","gastos_y_ingresos.fecha")
        ->where("tarjetas.id_usuario", "=", $usuario->id)
        ->get();

        // dd($gastos_ingresos);
        return view('Inicio', compact('fechaActual'));
    }
}
