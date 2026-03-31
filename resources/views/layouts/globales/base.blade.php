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
    <div class="wrapper">

        <!-- Cabecera -->
        {{-- No se hace un template porque se usa en toda la pagina --}}
        <header>
            <h1>Tecnologías Web - Taller 1</h1>

            <!-- menu de navegacion -->
            <nav class="menu-principal">
                <div>
                    <ul>
                        {{-- Si no está logueado, desactivamos visualmente los botones --}}
                        @php
                            $isDisabled = !Auth::check();
                            $disableStyle = $isDisabled ? 'color: #94a3b8; pointer-events: none; opacity: 0.5; cursor: not-allowed; text-decoration: none;' : '';
                        @endphp
                        
                        <li><a href="{{ $isDisabled ? '#' : route('home') }}" @class(['active' => Route::is('home')]) style="{{ $disableStyle }}">Inicio</a></li>
                        <li><a href="{{ $isDisabled ? '#' : route('tabla') }}" @class(['active' => Route::is('tabla')]) style="{{ $disableStyle }}">Ventas</a></li>
                        <li><a href="{{ $isDisabled ? '#' : route('acerca') }}" @class(['active' => Route::is('acerca')]) style="{{ $disableStyle }}">Acerca De</a></li>
                        <li><a href="{{ $isDisabled ? '#' : route('juego') }}" @class(['active' => Route::is('juego')]) style="{{ $disableStyle }}">Juegos</a></li>
                        <li><a href="{{ $isDisabled ? '#' : route('contacto') }}" @class(['active' => Route::is('contactos')]) style="{{ $disableStyle }}">Contacto</a></li>
                        
                        {{-- ===== Autenticación Manual ===== --}}
                        @guest
                            <li><a href="{{ route('login.show') }}" @class(['active' => Route::is('login.show')])>Ingresar</a></li>
                            <li><a href="{{ route('registro.show') }}" @class(['active' => Route::is('registro.show')])>Registro</a></li>
                        @else
                            <li>
                                {{-- El logout siempre debe ser por POST para evitar CSRF --}}
                                <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0; padding:0;">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="color: #ffcccc;">
                                        Salir ({{ Auth::user()->name }})
                                    </a>
                                </form>
                            </li>
                        @endguest
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
    
        <!-- pide de pagina-->
        <footer>
            <p>&copy; 2026 Taller 1 - Desarrollo Web | Fecha de entrega: 12-02-2026</p>
            <div class="validacion">
                <a href="http://validator.w3.org/check?uri=referer" target="_blank">
                    <img src="{{ asset('img/html401.png') }}" alt="Valid HTML 4.01" height="31" width="88">
                </a>
                <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                    <img src="{{ asset('img/vcss.png') }}" alt="Valid CSS" height="31" width="88">
                </a>
            </div>
        </footer>
    
    </div>
</body>

</html>
