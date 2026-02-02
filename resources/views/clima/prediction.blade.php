<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Predicciones</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100"> 
    <div class="container mx-auto px-4 py-8">
        
        <div class="nav-bar mb-8 flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm">
            <div>
                <h1 style="font-weight: 800; color: #2563eb; font-size: 1.5rem;">PREDICCIONES</h1>
                <p style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Análisis de Estaciones</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('clima.index') }}" class="btn btn-dark bg-slate-800 text-white px-4 py-2 rounded-lg">🏠 Inicio</a>
                <a href="{{ route('clima.administrar') }}" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-lg">⚙️ Ir a Registros</a>
            </div>
        </div>

        <div class="flex justify-center mb-12">
            <div class="card bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl border-t-4 border-blue-500">
                <h2 class="text-xl font-bold mb-6 text-center text-slate-800">Registrar Predicción Manual</h2>
                <form action="{{ route('prediccion.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div class="flex flex-col">
                        <label class="font-bold text-slate-600 mb-1">Ciudad:</label>
                        <select name="ciudad_id" class="border p-2 rounded-lg bg-slate-50" required>
                            @foreach($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label class="font-bold text-slate-600 mb-1">Estado Predicho:</label>
                        <select name="estado" class="border p-2 rounded-lg bg-slate-50" required>
                            <option value="Soleado">☀️ Soleado</option>
                            <option value="Nublado">☁️ Nublado</option>
                            <option value="Lluvia">🌧️ Lluvia</option>
                            <option value="Tormenta">⚡ Tormenta</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label class="font-bold text-slate-600 mb-1">Temperatura (°C):</label>
                        <input type="number" step="1" name="temperatura" class="border p-2 rounded-lg" placeholder="Ej: 24" required>
                    </div>

                    <div class="flex flex-col">
                        <label class="font-bold text-slate-600 mb-1">Fecha Proyectada:</label>
                        <input type="date" name="fecha" class="border p-2 rounded-lg" required>
                    </div>

                    <button type="submit" class="md:col-span-2 bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition duration-300 shadow-md">
                        ✨ Guardar y Generar ID 
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-12">
            <h2 class="p-6 font-bold text-slate-700 border-b">Historial de Predicciones Manuales</h2>
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                    <tr>
                        <th class="p-4 border-b">ID (Código)</th>
                        <th class="p-4 border-b">Ciudad</th>
                        <th class="p-4 border-b">Estado</th>
                        <th class="p-4 border-b">Temp.</th>
                        <th class="p-4 border-b">Fecha</th>
                        <th class="p-4 border-b text-center">Gestión</th>
                    </tr>
                </thead>
               <tbody>
                    @foreach($listaPredicciones as $p)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 border-b">
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-md font-mono font-bold">{{ $p->codigo }}</span>
                        </td>
                        <td class="p-4 border-b font-medium text-slate-700">{{ $p->ciudad_nombre }}</td>
                        <td class="p-4 border-b text-slate-900 font-semibold">{{ $p->estado }}</td>
                        <td class="p-4 border-b font-bold text-blue-600">{{ round($p->temperatura) }}°C</td>
                        <td class="p-4 border-b text-slate-500">
                            {{ \Carbon\Carbon::parse($p->fecha)->format('d/m/Y') }}
                        </td>
                        <td class="p-4 border-b">
                            <div class="flex items-center justify-center gap-4">
                                {{-- Lógica de edición: Solo si la fecha es hoy o futura --}}
                                @if(\Carbon\Carbon::parse($p->fecha)->greaterThanOrEqualTo($hoy))
                                    <a href="{{ route('prediccion.edit', $p->id) }}" class="text-amber-600 font-bold hover:underline">✏️ Editar</a>
                                @else
                                    <span class="text-slate-400 italic text-xs">No editable</span>
                                @endif

                                {{-- Formulario de borrado directo (sin confirmación del navegador) --}}
                                <form action="{{ route('prediccion.destroy', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg font-bold hover:bg-red-100 transition">
                                        🗑️ Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>