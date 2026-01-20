<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClimaController extends Controller
{
    // <!-- Index: vista principal -->
    public function index() {
        $climas = DB::table('climas')
            ->join('ciudades','climas.ciudad_id','=','ciudades.id')
            ->join('regiones','ciudades.region_id','=','regiones.id')
            ->select('climas.*','ciudades.nombre as ciudad','regiones.nombre as region')
            ->get();

        return view('clima.index', compact('climas'));
    }

    // <!-- create: vista de formulario -->
    public function create() {
        $ciudades = DB::table('ciudades')->get();
        return view('clima.create', compact('ciudades'));
    }

    // <!-- store: crear registro -->
    public function store(Request $request) {
        DB::table('climas')->insert([
            'ciudad_id'=>$request->ciudad_id,
            'estacion'=>$request->estacion,
            'temperatura'=>$request->temperatura,
            'descripcion'=>$request->descripcion
        ]);

        return redirect()->route('clima.index');
    }

    // <!-- show: detalla registro -->
    public function show($id) {
        $clima = DB::table('climas')->where('id',$id)->first();
        return view('clima.show', compact('clima'));
    }

    // <!-- edit: vista de formulario para editar -->
    public function edit($id) {
        $clima = DB::table('climas')->where('id',$id)->first();
        $ciudades = DB::table('ciudades')->get();
        return view('clima.edit', compact('clima','ciudades'));
    }

    // <!-- update -->
    public function update(Request $request, $id) {
        DB::table('climas')->where('id',$id)->update([
            'ciudad_id'=>$request->ciudad_id,
            'estacion'=>$request->estacion,
            'temperatura'=>$request->temperatura,
            'descripcion'=>$request->descripcion
        ]);

        return redirect()->route('clima.index');
    }

    // <!-- destroy: eliminar registro -->
    public function destroy($id) {
        DB::table('climas')->where('id',$id)->delete();
        return redirect()->route('clima.index');
    }
}

