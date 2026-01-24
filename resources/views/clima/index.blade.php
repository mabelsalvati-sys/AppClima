<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido</title>
        <link rel="stylesheet" href="{{ asset('css/estilos_clima.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="fondo-Inicio">
        <div class="container">
            <div class="nav-bar">
                <h1 style="font-weight: 800; italic">BIENVENIDO</h1>
                <div>
                    <a href="{{ route('clima.administrar') }}" class="btn btn-dark">⚙️ Ir a Registros</a>
                    <a href="{{ route('clima.predicciones') }}" class="btn btn-primary">☁️ Ir a Predicciones</a>
                </div>
            </div>
            <div class="card">
                <h2>Análisis Térmico</h2>
                <canvas id="climaChart" height="100"></canvas>
            </div>
        </div>
        <script>
            const ctx = document.getElementById('climaChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($fechas) !!},
                    datasets: [{
                        label: 'Temperatura °C',
                        data: {!! json_encode($temperaturas) !!},
                        borderColor: '#2563eb',
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(37, 99, 235, 0.1)'
                    }]
                }
            });
        </script>
    </body>
</html>
