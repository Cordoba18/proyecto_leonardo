<?php

namespace App\Http\Controllers;

use App\Models\Meta_ahorro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetasAhorrosController extends Controller
{
    //

    public function index(){

        $usuario = Auth::user();
        $metas_ahorros = Meta_ahorro::where("id_usuario","=",$usuario->id)->where("id_estado", "=", 1)->get();
        return view('metas_ahorro.show', compact('metas_ahorros'));
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

        return redirect()->route('metas_ahorro')->with("message", "Meta de ahorro editada correctamente!");

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
}
