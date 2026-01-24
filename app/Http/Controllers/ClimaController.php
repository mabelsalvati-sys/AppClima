<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClimaController extends Controller
{
    // 1. BIENVENIDA (Solo Gráfica y Botones)
    public function index() {
        $registros = DB::table('climas')
            ->join('ciudades', 'climas.ciudad_id', '=', 'ciudades.id')
            ->select('climas.*', 'ciudades.nombre as ciudad_nombre')
            ->orderBy('climas.created_at', 'asc')->get();
        
        $fechas = $registros->pluck('created_at')->map(fn($f) => Carbon::parse($f)->format('d/m H:i'));
        $temperaturas = $registros->pluck('temperatura');

        return view('clima.index', compact('registros', 'fechas', 'temperaturas'));
    }

    // 2. GESTIÓN (Guardar, Editar, Eliminar)
    public function administrar() {
        $registros = DB::table('climas')
            ->join('ciudades', 'climas.ciudad_id', '=', 'ciudades.id')
            ->select('climas.*', 'ciudades.nombre as ciudad_nombre')
            ->orderBy('climas.created_at', 'desc')->get();
        $ciudades = DB::table('ciudades')->get();

        return view('clima.gestion', compact('registros', 'ciudades'));
    }

    // 3. PREDICCIONES (Tarjetas con botones)
    public function predicciones() {
        $registros = DB::table('climas')
            ->join('ciudades', 'climas.ciudad_id', '=', 'ciudades.id')
            ->select('climas.*', 'ciudades.nombre as ciudad_nombre')->get();
        return view('clima.prediction', compact('registros'));
    }

    // 4. EDICIÓN
    public function edit($id) {
        $registro = DB::table('climas')->where('id', $id)->first();
        return view('clima.edit', compact('registro'));
    }

    // 5. DETALLE (Observación)
    public function show($id) {
        $registro = DB::table('climas')
            ->join('ciudades', 'climas.ciudad_id', '=', 'ciudades.id')
            ->select('climas.*', 'ciudades.nombre as ciudad_nombre')
            ->where('climas.id', $id)->first();
        return view('clima.show', compact('registro'));
    }

    // ACCIONES CRUD
    public function store(Request $request) {
        DB::table('climas')->insert([
            'ciudad_id' => $request->ciudad_id,
            'temperatura' => $request->temperatura,
            'estado_clima' => $request->estado_clima,
            'created_at' => $request->fecha ?? now(),
            'updated_at' => now()
        ]);
        return redirect()->route('clima.administrar')->with('success', 'Guardado con éxito');
    }

    public function update(Request $request, $id) {
        DB::table('climas')->where('id', $id)->update([
            'temperatura' => $request->temperatura,
            'estado_clima' => $request->estado_clima,
            'updated_at' => now()
        ]);
        return redirect()->route('clima.administrar')->with('success', 'Actualizado');
    }

    public function destroy($id) {
        DB::table('climas')->where('id', $id)->delete();
        return redirect()->back();
    }
}