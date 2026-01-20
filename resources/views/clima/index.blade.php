<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Climas</title>
    </head>
    <body>
        
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <div class="container">
            <h1 class="titulo">REGISTRO DE CLIMA</h1>
            <a href="{{ route('clima.create') }}" class="btn-nr">Nuevo Registro</a>

            <table>
                <div class="clima-grid">
                    @foreach($climas as $c)
                <div class="clima-box">

                <div class="clima-icon">
                    @if($c->descripcion=="Soleado") ☀️
                    @elseif($c->descripcion=="Nublado") ☁️
                    @elseif($c->descripcion=="Lluvia") 🌧️
                    @else 🌤️
                    @endif
                </div>

                <h3>{{ $c->ciudad }}</h3>
                <p>{{ $c->region }}</p>

                <div class="clima-temp">{{ $c->temperatura }}</div>
                <p>{{ $c->descripcion }} - {{ $c->estacion }}</p>

                <a href="{{ route('clima.show',$c->id) }}">Ver</a>
                <a href="{{ route('clima.edit',$c->id) }}">Editar</a>

                <form action="{{ route('clima.destroy',$c->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <br>
                    <button>Eliminar</button>
                </form>

                </div>
                    @endforeach
                </div>

            </table>
        </div>

    </body>
</html>