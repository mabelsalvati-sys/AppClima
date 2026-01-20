<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <div class="container">
            <h2 class="subtitulo">➕ Nuevo Registro Climático</h2>

            <form action="{{ route('clima.store') }}" method="POST">
            @csrf

            <label>Ciudad</label>
            <select name="ciudad_id" required>
                @foreach($ciudades as $c)
                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>

            <label>Estación</label>
            <select name="estacion">
                <option>Verano</option>
                <option>Otoño</option>
                <option>Invierno</option>
                <option>Primavera</option>
            </select>

            <label>Temperatura</label>
            <input type="text" name="temperatura" placeholder="Ej: 28°C" required>

            <label>Descripción</label>
            <input type="text" name="descripcion" placeholder="Ej: Soleado" required>

            <button>Guardar</button>
            </form>

            <a href="{{ route('clima.index') }}" class="btn-vl">⬅ Volver</a>
        </div>

    </body>
</html>