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
        'css/productos.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
    ]
];
function createCard($title, $img, $id){
    return '
    <!--CARD-->
        <div class="card-wrapper">
            <div class="card">
                <div class="image">
                    <img src="'.$img.'" alt="'.$title.'">
                </div>
                <div class="title">
                     '.$title.'
                </div>
                <div class="boton-wrapper">
                <a class="boton" href="'.$id.'">
                Alquilar
                </a>
                </div>
            </div>
        </div>
    ';
}
function getContent()
{
    for ($i=0; $i<15; $i++){
        $cards .= createCard("Taladro", "./img/herramienta.png", "");
    }
    $content = '
    <div class="product-container-text-wrapper">
        <div class="product-container-text">
        <span>Catálogo de Productos</span>
        </div>
    </div>
    <div class="product-container-wrapper">
        <div class="product-container">
            '.$cards.'
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);