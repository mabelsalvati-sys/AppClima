<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="card" style="max-width: 500px; width: 100%;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-weight: 800; text-transform: uppercase italic;">Actualizar Datos</h1>
            <p style="color: #64748b; font-size: 0.8rem;">Registro ID: #{{ $registro->id }}</p>
        </div>

        <form action="{{ route('clima.update', $registro->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="label-text">Nueva Temperatura (°C)</label>
                <input type="number" step="0.1" name="temperatura" value="{{ $registro->temperatura }}" required class="input-style">
            </div>

            <div class="form-group">
                <label class="label-text">Estado / Estación</label>
                <input type="text" name="estado_clima" value="{{ $registro->estado_clima }}" required class="input-style">
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 1rem;">💾 Guardar Cambios</button>
                
                <div style="display: flex; gap: 10px;">
                    <button type="button" onclick="window.history.back()" class="btn btn-dark" style="flex: 1; background: #64748b;">← Volver</button>
                    <a href="{{ route('clima.index') }}" class="btn btn-dark" style="flex: 1; text-align: center;">🏠 Inicio</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
