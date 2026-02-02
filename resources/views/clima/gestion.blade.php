<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestión</title>
        <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="fondo-gestion">
        <div class="container mx-auto px-4 py-8 flex flex-col items-center">
            
            <div class="nav-bar w-full max-w-6xl flex justify-between items-center mb-10 bg-slate-900/50 p-4 rounded-xl backdrop-blur-sm">
                <div class="flex gap-4">
                    <a href="{{ route('clima.index') }}" class="btn btn-dark bg-emerald-500 text-white px-4 py-2 rounded-lg font-bold">🏠 Inicio</a>
                    <a href="{{ route('clima.predicciones') }}" class="btn bg-blue-600 text-white px-4 py-2 rounded-lg font-bold shadow-lg hover:bg-blue-700 transition">
                        🔮 Ver Predicciones
                    </a>
                </div>
                <h1 class="text-white font-black text-xl tracking-widest">PANEL DE GESTIÓN</h1>
            </div>

            <div class="w-full max-w-lg mb-16">
                <div class="card bg-white/90 backdrop-blur-md p-8 rounded-3xl shadow-2xl border-b-8 border-emerald-500">
                    <h3 class="text-center font-black text-slate-800 text-2xl mb-6 uppercase tracking-tight">Nuevo Registro</h3>
                    <form action="{{ route('clima.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Región</label>
                            <select name="ciudad_id" class="w-full border-2 border-slate-200 p-3 rounded-xl focus:border-emerald-500 outline-none transition">
                                @foreach($ciudades as $c) 
                                    <option value="{{ $c->id }}">{{ $c->nombre }}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Temperatura (°C)</label>
                            <input type="number" step="1" name="temperatura" class="w-full border-2 border-slate-200 p-3 rounded-xl focus:border-emerald-500 outline-none" placeholder="Ej: 18" required>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Estación Climática</label>
                            <input type="text" name="estado_clima" class="w-full border-2 border-slate-200 p-3 rounded-xl focus:border-emerald-500 outline-none" placeholder="Ej: Nublado" required>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Fecha de Registro</label>
                            <input type="date" name="fecha" class="w-full border-2 border-slate-200 p-3 rounded-xl focus:border-emerald-500 outline-none" required>
                        </div>
                       
                        <button type="submit" class="w-full bg-emerald-500 text-white font-black py-4 rounded-2xl hover:bg-emerald-600 transform hover:scale-[1.02] transition shadow-lg">
                            💾 GUARDAR REGISTRO
                        </button>
                    </form>
                </div>
            </div>

            <div class="w-full max-w-6xl">
                <div class="overflow-hidden rounded-3xl shadow-2xl bg-white/95">
                    <table class="w-full text-left">
                        <thead class="bg-slate-900 text-white text-sm uppercase tracking-widest">
                            <tr>
                                <th class="p-5">Código</th> <th class="p-5">Región</th>
                                <th class="p-5">Estación</th>
                                <th class="p-5">Fecha</th>
                                <th class="p-5">Temperatura</th>
                                <th class="p-5 text-center">Gestión</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($registros as $r)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-5 font-mono text-emerald-600 font-bold">{{ $r->codigo }}</td> <td class="p-5 font-bold text-slate-800">{{ $r->ciudad_nombre }}</td>
                                <td class="p-5 text-slate-600 font-medium">{{ $r->estado_clima }}</td>
                                <td class="p-5 text-slate-400 text-sm">
                                    {{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y') }}
                                </td>
                                <td class="p-5">
                                    <span class="bg-blue-100 text-blue-600 px-4 py-1 rounded-full font-black">
                                        {{ round($r->temperatura) }}°C
                                    </span>
                                </td>
                                <td class="p-5 flex justify-center gap-3">
                                    {{-- LÓGICA DE MARÍA BELÉN: No mostrar editar si la fecha es pasada --}}
                                    @if(\Carbon\Carbon::parse($r->created_at)->greaterThanOrEqualTo($hoy))
                                        <a href="{{ route('clima.edit', $r->id) }}" class="bg-amber-100 text-amber-600 px-4 py-2 rounded-xl font-bold hover:bg-amber-200 transition">✏️ Editar</a>
                                    @else
                                        <span class="text-slate-400 italic text-sm self-center">No editable</span>
                                    @endif

                                    <form action="{{ route('clima.destroy', $r->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-100 text-red-600 px-4 py-2 rounded-xl font-bold hover:bg-red-200 transition">
                                            🗑️ Borrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </body>
</html>