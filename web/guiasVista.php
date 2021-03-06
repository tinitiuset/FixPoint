<?php
require "functions.php";

use Grupo3\FixPoint\model\GuiaDespiece;
use Grupo3\FixPoint\Connection;


$args = [
    'title' => 'Guias despiece',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
        'css/crearGuia.css',
        'css/productos.css'
    ],

    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',

    ]
];

function createCardGuia($title, $img, $id): string
{
    $card = '
        <div class="card-wrapper">
            <div class="card">
                <div class="image">
                    <img src="' . $img . '" alt="' . $title . '">
                </div>
                <div class="title">
                    ' . $title . '
                </div>
                <div class="boton-wrapper">
        <form action="" method="post" id="forMostrarGuia">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="submit" formaction="./guia.php" class="botonGuiasVista boton" value="Mostrar" name="btnMostrarGuia">
        </form>';

    $card .= '
                    </div>
                </div>
             </div>';
    return $card;

}

function getContent()
{
    /*CONSEGUIMOS LAS GUIAS DE BBDD*/
    $query = Connection::executeQuery("select * from guiaDespiece")->fetchAll();
    $cards = '';
    foreach ($query as $guia) {
        /*Conseguir foto de paso 1*/
        $fotoPasoUno = Connection::executeQuery('select * from `paso`  WHERE `numpaso` = 1 and `numFicha` ="' . $guia['numFicha'] . '" ')->fetchAll();

        $cards .= createCardGuia($guia['nombreMaquina'], $fotoPasoUno[0]['foto'], $guia['numFicha']);
    }


    $txtCreacionGuia = '<p>¿Quieres crear una nueva guia? <a href="crearGuia.php">¡Click Aqui!</a></p>';

    /*Operador ternario para mostrar mensaje para crear nueva guia si hay un usuario logueado*/
    isset($_SESSION['logged']) ? $txtCreacionGuia : $txtCreacionGuia='';

    $content = '
    <div class="product-container-text-wrapper">
        <div class="product-container-text">
        <h2 class="blackTittle">Guias despiece</h2>
        </div>
        ' . $txtCreacionGuia . '
    </div>
    <div class="product-container-wrapper">
        <div class="product-container">
            ' . $cards . '
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);