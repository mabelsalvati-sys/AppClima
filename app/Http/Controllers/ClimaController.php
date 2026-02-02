<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClimaController extends Controller
{
    /**
     * Genera códigos automáticos (Ej: LO-001) basándose en las iniciales de la ciudad.
     * Corregido para evitar errores de variable indefinida.
     */
    private function generarCodigo($ciudad_id, $tabla) {
        $ciudad = DB::table('ciudades')->where('id', $ciudad_id)->first();
        if (!$ciudad) return "XX-000";

        // Definimos el prefijo ANTES de usarlo en la consulta
        $prefijo = strtoupper(substr($ciudad->nombre, 0, 2)); 
        
        $ultimo = DB::table($tabla)
            ->where('codigo', 'LIKE', $prefijo . '-%')
            ->orderBy('id', 'desc')
            ->first();
        
        if ($ultimo) {
            $numero = intval(substr($ultimo->codigo, 3)) + 1;
        } else {
            $numero = 1;
        }
        
        $numeroFinal = str_pad($numero, 3, '0', STR_PAD_LEFT); 
        return $prefijo . '-' . $numeroFinal;
    }

    /**
     * Vista principal con la gráfica.
     */
    public function index() {
        $reales = DB::table('climas')->orderBy('created_at', 'desc')->take(10)->get()->reverse();
        $predicciones = DB::table('predicciones')->orderBy('fecha', 'desc')->take(10)->get()->reverse();

        $labels = $reales->pluck('created_at')->map(function($fecha) {
            return Carbon::parse($fecha)->format('d/m/Y'); 
        })->toArray();

        // Round() para que en la gráfica solo aparezcan enteros
        $temp_reales = $reales->pluck('temperatura')->map(fn($t) => round($t))->toArray();
        $temp_predicciones = $predicciones->pluck('temperatura')->map(fn($t) => round($t))->toArray();

        return view('clima.index', compact('labels', 'temp_reales', 'temp_predicciones'));
    }

    // --- MÉTODOS PARA CLIMAS (GESTIÓN) ---

    public function administrar() {
        $registros = DB::table('climas')
            ->join('ciudades', 'climas.ciudad_id', '=', 'ciudades.id')
            ->select('climas.*', 'ciudades.nombre as ciudad_nombre')
            ->orderBy('climas.created_at', 'desc')
            ->get();

        $ciudades = DB::table('ciudades')->get();
        $hoy = Carbon::today(); 

        return view('clima.gestion', compact('registros', 'ciudades', 'hoy'));
    }

    public function store(Request $request) {
        $nuevoCodigo = $this->generarCodigo($request->ciudad_id, 'climas');
        $fechaSolo = Carbon::parse($request->fecha)->format('Y-m-d');

        DB::table('climas')->insert([
            'codigo'       => $nuevoCodigo,
            'ciudad_id'    => $request->ciudad_id,
            'temperatura'  => round($request->temperatura),
            'estado_clima' => $request->estado_clima,
            'created_at'   => $fechaSolo,
            'updated_at'   => now(),
        ]);

        return redirect()->back()->with('success', "Registro exitoso: $nuevoCodigo");
    }

    public function edit($id) {
        $registro = DB::table('climas')->where('id', $id)->first();
        return view('clima.edit', compact('registro'));
    }

    public function update(Request $request, $id) {
        DB::table('climas')->where('id', $id)->update([
            'temperatura' => round($request->temperatura),
            'estado_clima' => $request->estado_clima,
            'updated_at' => now()
        ]);
        return redirect()->route('clima.administrar')->with('success', 'Actualizado correctamente');
    }

    public function destroy($id) {
        DB::table('climas')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Registro eliminado');
    }

    public function show($id) {
        $registro = DB::table('climas')
            ->join('ciudades', 'climas.ciudad_id', '=', 'ciudades.id')
            ->select('climas.*', 'ciudades.nombre as ciudad_nombre')
            ->where('climas.id', $id)->first();
        return view('clima.show', compact('registro'));
    }

    // --- MÉTODOS PARA PREDICCIONES (NUEVOS) ---

    public function predicciones() {
        $ciudades = DB::table('ciudades')->get();
        $hoy = Carbon::today();

        $listaPredicciones = DB::table('predicciones')
            ->join('ciudades', 'predicciones.ciudad_id', '=', 'ciudades.id')
            ->select('predicciones.*', 'ciudades.nombre as ciudad_nombre')
            ->orderBy('predicciones.fecha', 'desc')
            ->get();

        return view('clima.prediction', compact('ciudades', 'listaPredicciones', 'hoy'));
    }

    public function storePrediccion(Request $request) {
        $nuevoCodigo = $this->generarCodigo($request->ciudad_id, 'predicciones');

        DB::table('predicciones')->insert([
            'codigo'      => $nuevoCodigo,
            'ciudad_id'   => $request->ciudad_id,
            'estado'      => $request->estado,
            'temperatura' => round($request->temperatura),
            'fecha'       => $request->fecha,
        ]);

        return redirect()->back()->with('success', "Predicción guardada: $nuevoCodigo");
    }

    // Agregado para solucionar error de método no definido
    public function destroyPrediccion($id) {
        DB::table('predicciones')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Predicción eliminada');
    }

    public function editPrediccion($id) {
        $prediccion = DB::table('predicciones')->where('id', $id)->first();
        $ciudades = DB::table('ciudades')->get();
        return view('clima.edit_prediccion', compact('prediccion', 'ciudades'));
    }

    public function updatePrediccion(Request $request, $id) {
        DB::table('predicciones')->where('id', $id)->update([
            'estado' => $request->estado,
            'temperatura' => round($request->temperatura),
            'fecha' => $request->fecha,
        ]);
        return redirect()->route('clima.predicciones')->with('success', 'Actualizado correctamente');
    }
}