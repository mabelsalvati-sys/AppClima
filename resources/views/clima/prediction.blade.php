<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Predicciones</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <div>
                <h1 style="font-weight: 800; color: var(--primary);">PREDICCIONES</h1>
                <p style="font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Análisis de Estaciones</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('clima.index') }}" class="btn btn-dark">🏠 Inicio</a>
                <a href="{{ route('clima.administrar') }}" class="btn btn-primary">⚙️ Gestión</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($registros as $r)
            <div class="card" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                    <h3 style="font-weight: 800; margin: 0;">{{ $r->ciudad_nombre }}</h3>
                    <span style="font-size: 2rem;">⛅</span>
                </div>

                <div style="margin-bottom: 2rem;">
                    <span style="font-size: 3rem; font-weight: 800; color: var(--primary);">{{ $r->temperatura }}°C</span>
                    <p style="font-style: italic; color: #64748b; margin-top: 0.5rem;">"{{ $r->estado_clima }}"</p>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('clima.show', $r->id) }}" class="btn btn-primary" style="grid-column: span 2; text-align: center;">👁️ Ver Detalle</a>
                    <a href="{{ route('clima.edit', $r->id) }}" class="btn btn-dark" style="text-align: center; background: #fbbf24; color: #000;">✏️ Editar</a>
                    <button onclick="window.history.back()" class="btn btn-dark" style="background: #e2e8f0; color: #475569;">← Volver</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
