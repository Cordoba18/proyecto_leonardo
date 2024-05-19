<?php

namespace App\Http\Controllers;

use App\Models\Gasto_y_ingreso;
use Carbon\Carbon;
use App\Models\Meta_ahorro;
use App\Models\Tarjeta;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetasAhorrosController extends Controller
{
    //

    public function index(){

        $usuario = Auth::user();
        $metas_ahorros = Meta_ahorro::where("id_usuario","=",$usuario->id)->where("id_estado", "=", 1)->get();
        $tarjetas = Tarjeta::join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_tarjetas", "tarjetas.id_tipo_tarjeta","tipos_tarjetas.id")
        ->select("tarjetas.id", "tarjetas.numero", "tarjetas.cuota_manejo", "tarjetas.fecha_cuota_manejo", "tarjetas.nombre_banco", "asociaciones_tarjetas.asociacion","tipos_tarjetas.tipo" )
        ->where("tarjetas.id_usuario", '=', $usuario->id)
        ->where("tarjetas.id_estado", '=', 1)
        ->get();

        return view('metas_ahorro.show', compact('metas_ahorros', 'tarjetas'));
    }

    public function create(){
        return view('metas_ahorro.create');
    }

    public function save(Request $request){

        $usuario = Auth::user();
        $new_meta_ahorro = new Meta_ahorro();
        $new_meta_ahorro->nombre = $request->nombre;
        $new_meta_ahorro->descripcion = $request->descripcion;
        $new_meta_ahorro->valor = $request->valor;
        $new_meta_ahorro->fecha_inicio = $request->fecha_inicio;
        $new_meta_ahorro->fecha_final = $request->fecha_final;
        $new_meta_ahorro->id_usuario = $usuario->id;
        $new_meta_ahorro->id_estado = 1;
        $new_meta_ahorro->save();

        return redirect()->route('metas_ahorro')->with("message", "Meta de ahorro generada correctamente!");

    }

    public function update(Request $request){

        $usuario = Auth::user();
        $meta_ahorro = Meta_ahorro::find($request->id_meta_ahorro);
        $meta_ahorro->nombre = $request->nombre;
        $meta_ahorro->descripcion = $request->descripcion;
        $meta_ahorro->valor = $request->valor;
        $meta_ahorro->fecha_inicio = $request->fecha_inicio;
        $meta_ahorro->fecha_final = $request->fecha_final;
        $meta_ahorro->save();

        return redirect()->route('metas_ahorro.editar', $request->id_meta_ahorro)->with("message", "Meta de ahorro editada correctamente!");

    }

    public function delete(Request $request){

        $usuario = Auth::user();
        $meta_ahorro = Meta_ahorro::find($request->id_meta_ahorro);
        $meta_ahorro->id_estado = 2;
        $meta_ahorro->save();

        return redirect()->route('metas_ahorro')->with("message", "Meta de ahorro eliminada correctamente!");

    }

    public function edit($id,Request $request){

        $usuario = Auth::user();
        $meta_ahorro = Meta_ahorro::find($id);

        return view('metas_ahorro.edit', compact('meta_ahorro'));

    }

    public function datos_tarjetas_mis_ahorros(Request $request){

        $fechaActual = Carbon::now();

        // Obtener el primer día del mes
        $primerDiaDelMes = $fechaActual->firstOfMonth();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoPrimerDiaDelMes = $primerDiaDelMes->format('Y-m-d');

        $ultimoDiaDelMes = $fechaActual->lastOfMonth();

        // Formatear la fecha como 'YYYY-MM-DD'
        $formatoUltimoDiaDelMes = $ultimoDiaDelMes->format('Y-m-d');

        $usuario = Auth::user();
        if ($request->id_tarjeta) {
            $gastos_ingresos = Gasto_y_ingreso::where("id_tarjeta", "=", $request->id_tarjeta)
            ->where(function($query) use ($formatoUltimoDiaDelMes, $formatoPrimerDiaDelMes) {
                $query->whereBetween("fecha", [$formatoPrimerDiaDelMes, $formatoUltimoDiaDelMes])
                      ->orWhere("id_tipo_periodo", "=", 2);
            })
            ->where("id_estado", "=", 1)
            ->get();

            $tarjetas = Tarjeta::join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
        ->join("tipos_tarjetas", "tarjetas.id_tipo_tarjeta","tipos_tarjetas.id")
        ->select("tarjetas.cuota_manejo")
        ->where("tarjetas.id", '=', $request->id_tarjeta)
        ->where("tarjetas.id_usuario", '=', $usuario->id)
        ->where("tarjetas.id_estado", '=', 1)
        ->get();
        }else{

            $gastos_ingresos = Gasto_y_ingreso::join("tarjetas", "gastos_y_ingresos.id_tarjeta", "tarjetas.id")
    ->select("gastos_y_ingresos.valor", "gastos_y_ingresos.id_tipo_dinero","gastos_y_ingresos.id_tipo_periodo")
    ->where("tarjetas.id_usuario", "=", $usuario->id)
    ->where(function($query) use ($formatoUltimoDiaDelMes, $formatoPrimerDiaDelMes) {
        $query->whereBetween("gastos_y_ingresos.fecha", [$formatoPrimerDiaDelMes, $formatoUltimoDiaDelMes])
              ->orWhere("gastos_y_ingresos.id_tipo_periodo", "=", 2);
    })
    ->where("gastos_y_ingresos.id_estado", "=", 1)
    ->where("tarjetas.id_estado", "=", 1)
    ->get();
    $tarjetas = Tarjeta::join("asociaciones_tarjetas","tarjetas.id_asociacion_tarjeta","asociaciones_tarjetas.id")
    ->join("tipos_tarjetas", "tarjetas.id_tipo_tarjeta","tipos_tarjetas.id")
    ->select("tarjetas.cuota_manejo")
    ->where("tarjetas.id_usuario", '=', $usuario->id)
    ->where("tarjetas.id_estado", '=', 1)
    ->get();
        }

        return response()->json(['gastos_ingresos' => $gastos_ingresos, 'tarjetas'=> $tarjetas], 200);

    }
    public function dastos_grafica_mi_ahorro($id, Request $request){
        $meta_ahorro = Meta_ahorro::find($id);
        $zonaHorariaColombia = new DateTimeZone('America/Bogota');
        $startDate = Carbon::createFromFormat('Y-m-d', "$meta_ahorro->fecha_inicio");
        $endDate = Carbon::createFromFormat('Y-m-d', "$meta_ahorro->fecha_final");
        $fechaActual = Carbon::now($zonaHorariaColombia)->format('Y-m-d');
        $fechaActual = Carbon::createFromFormat('Y-m-d', "$fechaActual");

        // Calcula la diferencia en días
        $DiasHastaLafecha = (int) $startDate->diffInDays($fechaActual);
        $differenceInDays = (int) $startDate->diffInDays($endDate);
        $differenceInWeeks =  (int)$startDate->diffInWeeks($endDate);
        $differenceInMonths =  (int)$startDate->diffInMonths($endDate);
        $differenceInYears = (int) $startDate->diffInYears($endDate);
        $differenceInQuincenas = (int) ($differenceInDays / 15);

        if ($differenceInDays == 0) {
            $differenceInDays = 1;
        }

        if ($differenceInWeeks == 0) {
            $differenceInWeeks = 1;
        }

        if ($differenceInMonths == 0) {
            $differenceInMonths = 1;
        }

        if ($differenceInYears == 0) {
            $differenceInYears = 1;
        }

        if ($differenceInQuincenas == 0) {
            $differenceInQuincenas = 1;
        }



        $valor_por_dia = (int) round($meta_ahorro->valor / $differenceInDays);
        $valor_de_inicio_a_hoy = $valor_por_dia * $DiasHastaLafecha;
        $valor_por_semana = (int) round($meta_ahorro->valor / $differenceInWeeks);
        $valor_por_mes = (int) round($meta_ahorro->valor / $differenceInMonths);
        $valor_por_anual = (int) round($meta_ahorro->valor /$differenceInYears);
        $valor_por_quincena = (int) round($meta_ahorro->valor /$differenceInQuincenas);


        if ($valor_de_inicio_a_hoy > $meta_ahorro->valor) {
           $valor_de_inicio_a_hoy = $meta_ahorro->valor;
        }
        $tiempos_grafica = array("AHORRO DIARIO", "AHORRO SEMANAL","AHORRO QUINCENAL", "AHORRO MENSUAL", "AHORRO ANUAL");
        $valores_grafica = [
            'name' => "FORMAS DE AHORRO",
            'data'=>[$valor_por_dia, $valor_por_semana,$valor_por_quincena, $valor_por_mes, $valor_por_anual],
        ];
        return response()->json(['tiempos_grafica' => $tiempos_grafica,'valores_grafica' => $valores_grafica, 'valor_de_inicio_a_hoy'=> $valor_de_inicio_a_hoy ], 200);
    }
}
