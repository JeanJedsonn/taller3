@extends('layouts.globales.base')

@section('contenido')
    <!-- DATOS NO ESTANDARIZADOS -->
    <section class="seccion-generica">
        <h2>Estadísticas de Juegos</h2>
        <div class="table-responsive">
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>Juego</th>
                        <th>Ventas (USD)</th>
                        <th>Unidades Vendidas</th>
                        <th>Plataforma</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Call of Duty</td>
                        <td>10$</td>
                        <td>10</td>
                        <td>PS5</td>
                    </tr>
                    <tr>
                        <td>CRASH</td>
                        <td>20$</td>
                        <td>20</td>
                        <td>PS4</td>
                    </tr>
                    <tr>
                        <td>MK11</td>
                        <td>30$</td>
                        <td>30</td>
                        <td>PS4</td>
                    </tr>
                    <tr>
                        <td>JAMS</td>
                        <td>40$</td>
                        <td>40</td>
                        <td>PS4</td>
                    </tr>
                    <tr>
                        <td>BF7</td>
                        <td>50$</td>
                        <td>50</td>
                        <td>PS5</td>
                    </tr>
                    <tr>
                        <td>RAYMAN</td>
                        <td>60$</td>
                        <td>60</td>
                        <td>PS4</td>
                    </tr>
                    <tr>
                        <td>DOOM</td>
                        <td>70$</td>
                        <td>70</td>
                        <td>PS5</td>
                    </tr>
                    <tr>
                        <td>FC 26</td>
                        <td>80$</td>
                        <td>80</td>
                        <td>PS5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="seccion-generica">

        <h2>Visualización de Datos</h2>
        <p>Representación gráfica de las ganancias generadas por cada juego:</p>

        <!-- Contenedor donde Plotly dibujará el gráfico -->
        <div id="miPlot" style="width:100%;max-width:800px;margin:auto;"></div>

        <!-- Cargar librería Plotly.js desde CDN -->
        <script src="https://cdn.plot.ly/plotly-2.32.0.min.js" charset="utf-8"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Definir los datos a graficar (Eje X: Nombres, Eje Y: Valores en USD)
                var data = [{
                    x: ['COD', 'CRASH', 'MK11', 'JAMS', 'BF7', 'RAYMAN', 'DOOM', 'FC 26'],
                    y: [10, 20, 30, 40, 50, 60, 70, 80],
                    type: 'bar',
                    marker: {
                        color: 'rgba(54, 162, 235, 0.7)',
                        line: {
                            color: 'rgba(54, 162, 235, 1)',
                            width: 1.5
                        }
                    }
                }];

                // Opciones de estilo y diseño del plot
                var layout = {
                    title: 'Ganancias por Juego (USD)',
                    xaxis: { title: 'Juegos' },
                    yaxis: { title: 'Ingresos ($)' },
                    paper_bgcolor: 'rgba(0,0,0,0)', // fondo transparente
                    plot_bgcolor: 'rgba(240,240,240,0.5)',
                    margin: { t: 50, b: 50, l: 50, r: 50 }
                };

                // Renderizar el plot
                Plotly.newPlot('miPlot', data, layout, {responsive: true});
            });
        </script>
    </section>
@endsection
