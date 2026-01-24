<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestión</title>
        <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
        <script src="https://cdn.tailwindcss.com"></script> </head>
    <body class="fondo-gestion">
        <div class="container">
            <div class="nav-bar">
                <a href="{{ route('clima.index') }}" class="btn btn-dark">🏠 Inicio</a>
                <h1 style="font-weight: 800">PANEL DE GESTIÓN</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="card">
                    <h3>Nuevo Registro</h3>
                    <form action="{{ route('clima.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="label-text">Región</label>
                            <select name="ciudad_id" class="input-style">
                                @foreach($ciudades as $c) <option value="{{ $c->id }}">{{ $c->nombre }}</option> @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-text">Temperatura</label>
                            <input type="number" step="0.1" name="temperatura" class="input-style">
                        </div>
                        <div class="form-group">
                            <label class="label-text">Estación Climática</label>
                            <input type="text" name="estado_clima" class="input-style">
                        </div>
                        <div class="form-group">
                            <label class="label-text">Fecha</label>
                            <input type="datetime-local" name="fecha" class="input-style">
                        </div>
                        <button type="submit" class="btn btn-success">💾 Guardar</button>
                    </form>
                </div>

                <div class="lg:col-span-8">
                    <div class="table-container shadow-xl"> <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Región</th>
                                    <th>Estación</th>
                                    <th>Fecha</th>
                                    <th>Temperatura</th>
                                    <th style="text-align: center;">Gestión</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registros as $r)
                                <tr>
                                    <td><strong style="color: var(--dark);">{{ $r->ciudad_nombre }}</strong></td>
                                    
                                    <td>
                                        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">
                                            {{ $r->estado_clima }}
                                        </span>
                                    </td>
                                    
                                    <td style="font-size: 0.8rem; color: #94a3b8;">
                                        {{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i') }}
                                    </td>
                                    
                                    <td>
                                        <span class="temp-badge">
                                            {{ $r->temperatura }}°C
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <div style="display: flex; justify-content: center; gap: 8px;">
                                            <a href="{{ route('clima.edit', $r->id) }}" class="btn" style="background: rgba(245, 158, 11, 0.1); color: #d97706; padding: 8px 12px;">
                                                ✏️Editar
                                            </a>
                                            
                                            <form action="{{ route('clima.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
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
            </div>
        </div>
    </body>
</html>
