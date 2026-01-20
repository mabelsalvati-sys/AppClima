<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <div class="container-clima-card">
            <h2 class="estado">🌤 Estado del Clima</h2>

            <h1>{{ $clima->temperatura }}</h1>
            <h3>{{ $clima->descripcion }}</h3>

            <p><strong>Estación:</strong> {{ $clima->estacion }}</p>

            <a href="{{ route('clima.index') }}">⬅ Volver</a>
        </div>

    </body>
</html>