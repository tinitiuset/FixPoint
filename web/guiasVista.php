<?php
require "functions.php";

use Grupo3\FixPoint\model\guiaDespiece;
use Grupo3\FixPoint\Connection;


$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
        'css/crearGuia.css',
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
    // Kint\Kint::dump($_SESSION);
    $content = '
<div class="guiaContainer">
        '. form().'
</div>
';
    echo $content;
}

function createCardGuia($title, $id) {
    
}

function form()
{
    $form = '';
    return $form;

}

getHeader($args);
getContent();
getFooter($args);

?>