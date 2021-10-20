<?php
require "functions.php";
$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/crear_sesion.css',
        'css/inicio_sesion.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
    ]
];

function getContent () {

    $content= '
    <div class="slideshow-container">
        <div class="slider fade">
        <img src="./img/back01.jpg" id="slider">
            <div class="text">
                <h2 id="titulo">¿Qué es FixPoint?</h2>
                <p class="floatText" id="parrafo">FixPoint es una iniciativa circular sostenible, 
                que busca provocar un cambio en el sistema de sobreproducción, 
                luchando por una economía circular con nuestra 
                <span class="bold">biblioteca de herramientas</span>.</p>
                <button class="btnDonar" id="btnDonar">Donar Herramientas</button>
            </div>
    </div>
        </div>
            <a class="back" id="back">&#10094</a>
            <a class="next" id="next">&#10095</a>
        </div>';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);