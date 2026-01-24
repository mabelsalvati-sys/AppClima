<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis Detallado</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen p-4">

    <div class="card" style="max-width: 600px; width: 100%; text-align: center; border-top: 10px solid var(--primary);">
        
        <div style="margin-bottom: 2rem;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📡</div>
            <h1 style="font-weight: 800; text-transform: uppercase; font-size: 2.5rem; margin: 0; letter-spacing: -2px;">
                {{ $registro->ciudad_nombre }}
            </h1>
            <p style="color: var(--primary); font-weight: 800; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 2px;">
                Reporte de Estación Meteorológica
            </p>
        </div>

        <div style="background-color: #f1f5f9; padding: 2rem; border-radius: 1.5rem; margin-bottom: 2rem; border: 1px dashed #cbd5e1;">
            <p style="font-size: 1.1rem; color: #475569; line-height: 1.6; font-style: italic;">
                "Actualmente, la estación registra un estado climático de 
                <span style="font-weight: 800; color: #0f172a;">{{ $registro->estado_clima }}</span> 
                con una intensidad térmica de 
                <span style="font-weight: 800; color: var(--primary);">{{ $registro->temperatura }}°C</span>. 
                Captura realizada el {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y') }} 
                    a las {{ \Carbon\Carbon::parse($registro->created_at)->format('H:i') }} horas."
            </p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <a href="{{ route('clima.index') }}" class="btn btn-primary" style="text-align: center; padding: 15px;">
                🏠 Regresar al Inicio
            </a>
            
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('clima.edit', $registro->id) }}" class="btn btn-dark" style="flex: 1; text-align: center; background: #fbbf24; color: black;">
                    ✏️ Editar Registro
                </a>
                <button onclick="window.history.back()" class="btn btn-dark" style="flex: 1; background: #e2e8f0; color: #475569;">
                    ← Volver Atrás
                </button>
            </div>
        </div>
    </div>

</body>
</html>