@extends('layouts.globales.base')

@section('contenido')
    <section class="seccion-generica">
        <h2>Acerca de</h2>
        <p>Las cuentas entregadas pueden ser retiradas en cualquier momento, siempre y cuando no se cumplan
            con los <a href="https://www.playstation.com/" target="_blank" class="enlace-decorado">terminos y condiciones</a>
            establecidos por la
            empresa.<br>
            <br>
            <span class="span-linea-subrayada">No esta permitido compartir las cuentas con otras personas</span>,
            ya que esto va en contra de los
            terminos y condiciones establecidos por la empresa.
            <br>
            <br>
            <span class="span-linea-destacada">El cliente tiene derecho a un reembolso si el producto no es
                entregado en un plazo de 24 horas.</span>
        </p>
    </section>

    <!-- DATOS NO ESTANDARIZADOS -->
    <section class="seccion-estilo1">
        <h2>CUENTA PRIMARIA</h2>
        <p class="paragraph-decorado">Las cuentas primarias le dan acceso al juego en su conola desde cualquier perfil, no necesita de
            una conexion a internet (luego de la descarga del juego). </p>
    </section>

    <section class="seccion-estilo2">
        <h2>CUENTA SECUNDARIA</h2>
        <p>Las cuentas secundarias solo se pueden jugar desde el perfil dueño de la cuenta, ademas de
            necesitar una conexion a internet para poder jugar el juego.</p>
    </section>

    <section class="seccion-estilo3">
        <h2>MEMBRESIA</h2>
        <p>Las membresias le dan acceso a beneficios exclusivos, como descuentos en juegos, contenido
            exclusivo y acceso anticipado a nuevos juegos.</p>
    </section>
@endsection
