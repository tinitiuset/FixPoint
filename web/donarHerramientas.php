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
    <h1 id="tituloTools">¡Necesitamos herramientas!</h1>
    <div class="contenedor">
        <div Class="imagen">
            <img class="imgHerramientas" src="./img/herramienta.jpeg">
        </div>
        <div class="parrafos">
        <p class="textDonar">Para mantener la biblioteca de herramientas de FixPoint en funcionamiento,
            pedimos a as personas que donen herramientas</p>
        <p class="textDonar">Estamos muy interesados ​​en donaciones de herramientas manuales, eléctricas, 
            de jardín, equipos de pintura, escaleras y maquinaria para trabajar la madera. 
            También nos gustaría herramientas más especializadas para trabajos como enyesado,
            alicatado y reparación de bicicletas. Para ser honesto, estamos abiertos a ofertas
            de cualquier otra herramienta que le gustaría donar.</p>
        <p class="textDonar">Idealmente, nos gustaría herramientas que estén en buenas condiciones para estar 
            listas para usar, pero también consideraremos herramientas que necesitan reparaciones
            para poder practicar en el taller de despiece</p>
        <p class="textDonar">Si tienes algo para donar, ¡nos encantaría saberlo!
            Solo completa el formulario de abajo. ¡Gracias!</p>
        </div>
        <div class="formulario">
        <form action="" method="post" id="formularioDonacion">
            <div class="contenedor">
                <fieldset>
                    <legend class="title">
                        <Font>Nombre</font>
                        <span>*</span>
                    </legend>
                    <div class="nombreApellido">
                        <label class="nombre">
                            <input class="inputForm" type="text" name="nombre" id="nombre"><br>
                            <span class="nombre">Primer nombre</span>
                        </label>
                    </div>
                    <div class="nombreApellido">
                        <label class="nombre">
                            <input class="inputForm" type="text" name="apellido" id="apellido"><br>
                            <span class="nombre">Apellido</span>
                        </label>
                    </div>
                </fieldset>
                <div>
                    <label class="titulo">Correo electrónico
                        <span>*</span>
                        <input class="inputForm" type="text" name="email">
                    </label>
                </div>
                <div>
                    <label class="titulo">Número de teléfono
                        <input class="inputForm" type="text" name="telefono">
                    </label>
                </div>
                <div>
                    <label class="titulo">¿Qué le gustaría donar?
                        <span>*</span>
                        <textarea id="textArea" name="donación"></textarea>
                    </label>
                </div>
        </form>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);