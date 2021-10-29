<?php
require "functions.php";


$args = [
    'title' => 'Donar Herramientas',
    'styles' => [
        'css/footer.css',
        'css/header.css',
        'css/index.css',
        'css/ventanasModales.css',
    ],

    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
    ]
];

function getContent () {
    $content= '
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);