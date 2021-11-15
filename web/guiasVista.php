<?php
require "functions.php";

use Grupo3\FixPoint\model\guiaDespiece;
use Grupo3\FixPoint\Connection;


$args = [
    'title' => 'Guias despiece',
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

function createCardGuia($title, $img, $id): string {
    $estado = Connection::executeQuery('SELECT `revisada` FROM `guiadespiece` WHERE `numFicha` = "' . $id . '";')->fetchAll();
    $card = '
        <div class="card-wrapper">
            <div class="card">
                <div class="image">
                    <img src="./img/herramientas/'.$img.'" alt="'.$title.'">
                </div>
                <div class="title">
                    '.$title.'
                </div>
                <div class="boton-wrapper">';
    if ($estado[0]['revisada']==0 || !isset($_SESSION['user'])) {
        $card .= '<button type="button" class="botonGuiasDesactivo" disabled>No Disponible</button>';
    } else {
        $card .= '
        <form action="" method="post" id="forMostrarGuia">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="submit" class="botonGuiasVista" value="Mostrar" name="btnMostrarGuia">
        </form>';
    }
    $card .= '
                    </div>
                </div>
             </div>';
    return $card;

}

function getContent()
{
    /*CONSEGUIMOS LAS HERREMIENTAS DE BBDD*/
    $query = Connection::executeQuery("select * from herramienta")->fetchAll();
    $cards = '';
    foreach ($query as $tool) {
        $cards .= createCard($tool['nombre'], $tool['foto'], $tool['id_herramienta']);
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

?>