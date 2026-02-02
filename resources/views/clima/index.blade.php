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
                <h1 style="font-weight: 800; font-style: italic;">BIENVENIDO</h1>
                <div>
                    <a href="{{ route('clima.administrar') }}" class="btn btn-dark">⚙️ Ir a Registros</a>
                    <a href="{{ route('clima.predicciones') }}" class="btn btn-primary">☁️ Ir a Predicciones</a>
                </div>
            </div>

            <div class="contenedor-grafica-principal">
                <h2>Análisis Térmico °C</h2>
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="temperaturaChart"></canvas>
                </div>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('temperaturaChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!}, 
                    // ... dentro de data: { labels: ..., 
                    datasets: [
                        {
                            label: 'Temperatura Real',
                            data: {!! json_encode($temp_reales) !!},
                            borderColor: '#3b82f6', // Azul para registros reales
                            fill: true,             // Activa el sombreado
                            backgroundColor: 'rgba(59, 130, 246, 0.2)', // Fondo azul suave
                            tension: 0.3
                        },
                        {
                            label: 'Predicción',
                            data: {!! json_encode($temp_predicciones) !!},
                            borderColor: '#ef4444', // Rojo para predicciones
                            fill: true,             // Activa el sombreado
                            backgroundColor: 'rgba(239, 68, 68, 0.2)', // Fondo rojo suave
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: { color: '#334155', font: { weight: 'bold' } }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: { color: '#e2e8f0' }, // Cuadrícula sutil
                            title: { display: true, text: 'Temperatura °C', color: '#64748b' }
                        },
                        x: {
                            grid: { display: false },
                            title: { display: true, text: 'Fechas', color: '#64748b' }
                        }
                    }
                }
            });
        </script>
    </body>
</html>