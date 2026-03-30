<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Ultima version estable: 7fee12d -->
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     
    {{-- @yield es para mostrar el contenido de una seccion --}}
    <title>@yield('title', 'Taller3')</title>

    <!-- Importando el CSS de la carpeta public directamente -->
    <link rel="stylesheet" href="{{ asset('css/taller1/taller1.css') }}">
    @stack('css')
</head>

<body class="bg-light">
        <!-- Cabecera -->
        {{-- No se hace un template porque se usa en toda la pagina --}}
        <header>
            <h1>Tecnologías Web - Taller 1</h1>

            <!-- menu de navegacion -->
            <nav class="menu-principal">
                <div>
                    <ul>
                        {{-- @class cambia la clase segun la condicion (ser la ruta activa) --}}
                        <li><a href="{{ route('home') }}" @class(['active' => Route::is('home')])>Inicio</a></li>
                        <li><a href="{{ route('tabla') }}" @class(['active' => Route::is('tabla')])>Ventas</a></li>
                        <li><a href="{{ route('acerca') }}" @class(['active' => Route::is('acerca')])>Acerca De</a></li>
                        <li><a href="{{ route('juego') }}" @class(['active' => Route::is('juego')])>Juegos</a></li>
                        <li><a href="{{ route('contacto') }}" @class(['active' => Route::is('contactos')])>Contacto</a></li>
                    </ul>
                </div>
            </nav>
        </header>

       
       
        <!-- contenedor de segmentos -->
        <div class="container">

            <!-- barra lateral -->
            <aside class="sidebar">
                <h2>Enlaces Externos</h2>
                <ul>
                    <li><a href="https://www.playstation.com/" target="_blank">PlayStation Network</a></li>
                    <li><a href="https://www.binance.com/" target="_blank">Binance</a></li>
                    <li><a href="https://www.buysellvouchers.com/" target="_blank">BuySellVouchers</a></li>
                </ul>
                <h2>Enlaces de Referencia</h2>
                <ul>
                    <li><a href="https://www.w3.org/" target="_blank">W3C - World Wide Web Consortium</a></li>
                    <li><a href="https://developer.mozilla.org/" target="_blank">MDN Web Docs</a></li>
                    <li><a href="https://www.w3schools.com/" target="_blank">W3Schools</a></li>
                    <li><a href="https://css-tricks.com/" target="_blank">CSS-Tricks</a></li>
                    <li><a href="https://stackoverflow.com/" target="_blank">Stack Overflow</a></li>
                </ul>
            </aside>

            <!-- contenedor de informacion -->
            <main class="contenido-principal">
                <!-- contenedor -->
                @yield('contenido')
            </main>
        </div>
    </div>
    
    
    <!-- pide de pagina-->
    <footer>
        <p>&copy; 2026 Taller 1 - Desarrollo Web | Fecha de entrega: 12-02-2026</p>
        <div class="validacion">
            <a href="http://validator.w3.org/check?uri=referer" target="_blank">
                <img src="./img/html401.png" alt="Valid HTML 4.01" height="31" width="88">
            </a>
            <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                <img src="./img/vcss.png" alt="Valid CSS" height="31" width="88">
            </a>
        </div>
    </footer>

</body>

</html>