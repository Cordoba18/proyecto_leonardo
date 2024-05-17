<?php

namespace App\Http\Controllers;

use App\Models\Gasto_y_ingreso;
use App\Models\Tarjeta;
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

//         $appid = 10617;
// $secret= 'd1cbb81ae1a73e342955';
// $host  = 'open-api.apac-ulucu.com';  // ULUCU Open platform domain
// $uri = '/h/KjNmK/device/get_device_status';
// $query_str = 'av=1&device_sn=Ub0000000542866896QB'; // GET parameter

// $md5_rand = $secret.$appid.$uri.$query_str; // Composition check factor
// $md5 = md5( $md5_rand );  // Use MD5 encryption. (Lowercase letters)
// $authorization = base64_encode( $appid.':'.$md5 ); // Generate 401 certification

// //////// Request ////////
// $request_url = "https://{$host}{$uri}?{$query_str}";
// $ch = curl_init( $request_url );
// curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_HTTPHEADER,
// array( 'Authorization:Basic '.$authorization ,
// 'Content-Type: application/x-www-form-urlencoded' ) );
// $result = curl_exec($ch);

// dd($result);


        // dd($gastos_ingresos);
        return view('Inicio', compact('fechaActual'));
    }


    public function dates_graficas(Request $request){

        $usuario = Auth::user();

        $fechaActual = Carbon::now();

        // Obtener el primer día del mes
        $primerDiaDeLaSemana = $fechaActual->startOfWeek();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoPrimerDiaDelaSemana= $primerDiaDeLaSemana->format('Y-m-d');

        $ultimoDiaDelaSemana = $fechaActual->endOfWeek();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoUltimoDiaDelaSemana = $ultimoDiaDelaSemana->format('Y-m-d');

        $gastos_ingresos = Gasto_y_ingreso::join("tarjetas","gastos_y_ingresos.id_tarjeta","tarjetas.id")
        ->join("tipos_tarjetas","tarjetas.id_tipo_tarjeta", "tipos_tarjetas.id")
        ->join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_periodos","gastos_y_ingresos.id_tipo_periodo","tipos_periodos.id")
        ->join("tipos_dineros","gastos_y_ingresos.id_tipo_dinero","tipos_dineros.id")
        ->select("asociaciones_tarjetas.asociacion", "tipos_tarjetas.tipo as tipo_tarjeta", "tarjetas.numero", "tarjetas.nombre_banco", "gastos_y_ingresos.detalle", "gastos_y_ingresos.valor", "gastos_y_ingresos.fecha", "tipos_periodos.periodo", "tipos_periodos.id as id_tipo_periodo","tipos_dineros.tipo as tipo_dinero", "gastos_y_ingresos.id_tipo_dinero", "gastos_y_ingresos.id")
        ->where("tarjetas.id_estado","=", 1)
        ->where("gastos_y_ingresos.id_estado","=", 1)
        ->where("tarjetas.id_usuario", "=", $usuario->id)
        ->where(function($query) use ($formatoUltimoDiaDelaSemana, $formatoPrimerDiaDelaSemana) {
            $query->whereBetween("gastos_y_ingresos.fecha", [$formatoPrimerDiaDelaSemana, $formatoUltimoDiaDelaSemana]);
        })->get();

        $tarjetas = Tarjeta::join("gastos_y_ingresos","tarjetas.id","gastos_y_ingresos.id_tarjeta")
        ->join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_tarjetas", "tarjetas.id_tipo_tarjeta","tipos_tarjetas.id")
        ->select("tarjetas.fecha_cuota_manejo","asociaciones_tarjetas.asociacion", "tipos_tarjetas.tipo as tipo_tarjeta","tarjetas.cuota_manejo", "tarjetas.numero", "tarjetas.nombre_banco")
        ->where("gastos_y_ingresos.id_estado","=", 1)
        ->where("tarjetas.id_usuario", '=', $usuario->id)
        ->where("tarjetas.id_estado", '=', 1)->where(function($query) use ($formatoUltimoDiaDelaSemana, $formatoPrimerDiaDelaSemana) {
            $query->whereBetween("tarjetas.fecha_cuota_manejo", [$formatoPrimerDiaDelaSemana, $formatoUltimoDiaDelaSemana]);
        })->get();


        return response()->json(['gastos_ingresos' => $gastos_ingresos, 'tarjetas'=> $tarjetas], 200);

    }
}
