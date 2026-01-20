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
            <h2>✏ Editar Registro</h2>

            <form action="{{ route('clima.update',$clima->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Ciudad</label>
            <select name="ciudad_id">
                @foreach($ciudades as $c)
                <option value="{{ $c->id }}" {{ $c->id==$clima->ciudad_id ? 'selected':'' }}>
                {{ $c->nombre }}
                </option>
                @endforeach
            </select>

            <label>Estación</label>
            <input type="text" name="estacion" value="{{ $clima->estacion }}">

            <label>Temperatura</label>
            <input type="text" name="temperatura" value="{{ $clima->temperatura }}">

            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ $clima->descripcion }}"><br><br>

            
            <button>Actualizar</button>
            </form>
            <br>
            <a href="{{ route('clima.index') }}" class="btn-vl">⬅ Volver</a>
        </div>

        
    </body>
</html>