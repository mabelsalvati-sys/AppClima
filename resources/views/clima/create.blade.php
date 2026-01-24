<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md text-center">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Registrar Clima</h2>
        <form action="{{ route('clima.store') }}" method="POST">
            @csrf
            <select name="ciudad_id" required class="w-full p-4 mb-4 bg-gray-50 rounded-xl border">
                @foreach($ciudades as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
            <input type="number" step="0.1" name="temperatura" placeholder="Temperatura °C" required class="w-full p-4 mb-4 bg-gray-50 rounded-xl border">
            <input type="text" name="estado_clima" placeholder="Ej: Soleado" required class="w-full p-4 mb-6 bg-gray-50 rounded-xl border">
            
            <button type="submit" class="w-full bg-green-500 text-white py-4 rounded-xl font-bold mb-4">Guardar Registro</button>
            <a href="{{ route('clima.index') }}" class="block text-blue-600 font-bold italic">🏠 Volver al principio</a>
        </form>
    </div>
</body>
</html>