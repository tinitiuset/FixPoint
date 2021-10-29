<?php
require "functions.php";


$args = [
    'title' => 'Donar Herramientas',
    'styles' => [
        'css/footer.css',
        'css/header.css',
        'css/index.css',
        'css/ventanasModales.css',
        'css/donar.css',
    ],

    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
    ]
];

function getContent () {
    $content= '
    <h2>¡Necesitamos herramientas!</h2>
    <div class="contenedor">
        <div Class="imagen">
            <img class="imgHerramientas" src="./img/herramienta.jpeg">
        </div>
        <div class="parrafos">
        <p>Para mantener la biblioteca de herramientas de FixPoint en funcionamiento,
            pedimos a as personas que donen herramientas</p>
        <p>Estamos muy interesados ​​en donaciones de herramientas manuales, eléctricas, 
            de jardín, equipos de pintura, escaleras y maquinaria para trabajar la madera. 
            También nos gustaría herramientas más especializadas para trabajos como enyesado,
            alicatado y reparación de bicicletas. Para ser honesto, estamos abiertos a ofertas
            de cualquier otra herramienta que le gustaría donar.</p>
        <p>Idealmente, nos gustaría herramientas que estén en buenas condiciones para estar 
            listas para usar, pero también consideraremos herramientas que necesitan reparaciones
            para poder practicar en el taller de despiece</p>
        <p>Si tienes algo para donar, ¡nos encantaría saberlo!
            Solo completa el formulario de abajo. ¡Gracias!</p>
        </div>
        <div class="formulario">
        <form action="" method="post" id="formularioDonacion">
            <label class="titulo">Nombre *</label>
                <input type="text" name="nombre">
                <input type="text" name="apellido">
            <label class="titulo">Correo electrónico *</label>
            <label class="titulo">Número de teléfono</label>
            <label class="titulo">¿Qué le gustaría donar? * </label>
            <label class="titulo"></label>


        </form>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);