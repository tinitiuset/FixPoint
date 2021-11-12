<?php

use Grupo3\FixPoint\model\guiaDespiece;

require "functions.php";


$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
    ],

    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js'
    ]
];

function getContent () {
    try {
        $guia = new guiaDespiece();
        $_POST['id'];
        $content= '';
    }catch (Exception $e)  {
        $content= 'No se ha selecionado niguna guia.';
    }
/*    Kint\Kint::dump($_SESSION);*/


    echo $content;
}

getHeader($args);
getContent();
getFooter($args);