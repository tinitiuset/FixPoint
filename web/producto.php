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
            <div class="imagen">Imagen</div>
            <div class="alquilar">Alquilar</div>
            <div class="detalles">Detalles</div>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);