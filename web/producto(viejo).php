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
        'css/producto.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',

    ]
];
function getContent()
{
    $content = '
    <div class="product-container-text-wrapper">
        <div class="product-container-text">
        <span>Herramienta</span>
        </div>
    </div>
    <div class="product-wrapper">
        <div class="product">
            <div class="imagen-wrapper">
            <img src="./img/herramienta.png" alt="Herramienta">
            </div>
            <div class="alquilar-wrapper">
                <div class="alquilar">
                <div>
                <span class="product-id">#34</span> -
                <span class="product-title">Taladro</span>
                </div>
                <div class="boton-wrapper">
                <a class="boton" href="">
                Alquilar
                </a>
                </div>
                </div>
            </div>
            <div class="detalles-wrapper">Detalles</div>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);