<?php

require_once "model/User.php";

use Grupo3\FixPoint\model\User;
use Grupo3\FixPoint\Connection;

require "functions.php";

$args = [
    'title' => 'Productos',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
        'css/productos.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',
        'js/reservar.js',
    ]
];

function createCard($title = '', $img = '', $id = ''): string
{
    $estado = Connection::executeQuery('SELECT `disponible` FROM `herramienta` WHERE `id_herramienta` = "'.$id.'";')->fetchAll();
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
    if ($estado[0]['disponible']==0) {
        $card .= '<button type="button" class="botonDesactivo" disabled>No Disponible</button>';
    } else {
        $card .= '
        <form action="" method="post" id="forAlquilar">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="submit" class="boton" onClick="modalAlquiler()" value="Reservar" name="btnReservar">
        </form>';
    }
    $card .= '
                    </div>
                </div>
             </div>';
    return $card;
}

function getContent($modalAlquiler)
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
        <h2 class="blackTittle">Catálogo de Productos<h2>
        </div>
    </div>
    '.$modalAlquiler.'
    <div class="product-container-wrapper">
        <div class="product-container">
            '.$cards.'
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
$modalAlquiler = ''; /*definimos la variable que contendrá el html del modal del alquiler
                     en función de la situación dependiendo si el usuario está logado o no*/

if ((isset($_POST['btnReservar'])) && (isset($_SESSION['user']))) {
    $estado = Connection::executeQuery('UPDATE `herramienta` SET `disponible` = 0 WHERE `id_herramienta` = "'.$_POST['id'].'";'); 
    $id = $_POST['id'];
    $disponible = Connection::executeQuery('SELECT `disponible` FROM `herramienta` WHERE `id_herramienta` = "'.$id.'";')->fetchAll();
    $estadoHerramienta = $disponible[0]['disponible'];
    $modalAlquiler =
    '<div class="modalConfirmarGuia" id="modalConfirmarGuia">
        <div class="modalContenidoConfirmar">
            <div class="modalHeaderConfirmar">
                <h1 id="tituloConfirmarGuia">¡Reserva confirmada!</h1>
            </div>
            <form action="" method="post">
            <p>En breve recibirá un email con los detalles para recoger su herramienta</p>
                <div class=botones>
                    <input type="submit" id="btnAceptarGuia"  formaction="./productos.php" name="btnConfirmarPasoAceptar" value="Aceptar">
                </div>
            </form>
        </div>
    </div>';
    if (isset($_SESSION["user"])) {
        $dniUser = $_SESSION["user"]->getDni();
        $nomUser = $_SESSION["user"]->getNombre();
        $apeUser = $_SESSION["user"]->getApellidos();
        $emailUser = $_SESSION["user"]->getEmail();
        Connection::executeQuery("INSERT INTO solicitudalquiler (dni, nombre, apellidos, email, id_herramienta, disponible)
            VALUES ('$dniUser', '$nomUser', '$apeUser', '$emailUser', '$id', '$estadoHerramienta')");
    }
} else if ((isset($_POST['btnReservar'])) && (!isset($_SESSION['user']))) {
    $modalAlquiler =
        '<div class="modalConfirmarGuia" id="modalConfirmarGuia">
            <div class="modalContenidoConfirmar">
                <div class="modalHeaderConfirmar">
                    <h1 id="tituloConfirmarGuia">Necesitas estar registrado para alquilar una herramienta</h1>
                </div>
                <form action="" method="post">
                    <div class=botones>
                        <input type="submit" id="btnAceptarGuia"  formaction="./index.php" name="btnConfirmarPasoAceptar" value="Aceptar">
                    </div>
                </form>
            </div>
        </div>';
}
getContent($modalAlquiler);
getFooter($args);
