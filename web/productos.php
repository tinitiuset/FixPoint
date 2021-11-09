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
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',
        'js/reservar.js',
    ]
];

  

function createCard($title, $img = '',$id)
{
    
        $estado = Connection::executeQuery('SELECT `disponible` FROM `herramienta` WHERE `id_herramienta` = "'.$id.'";')->fetchAll();
    if (isset($_SESSION["user"])) {  

        if($estado[0]['disponible']==0){

        return '
        <!--CARD-->
            <div class="card-wrapper">
                <div class="card">
                    <div class="image">
                        <img src="./img/herramientas/'.$img.'" alt="'.$title.'">
                    </div>
                    <div class="title">
                        '.$title.'
                    </div>
                    <div class="boton-wrapper">
                    <button type="button" class="botonDesactivo" disabled>No Disponible</button>
                    </div>
                </div>
            </div>
        ';
        } else {

            return '
            <!--CARD-->
            <form action="" method="post" id="forAlquilar">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="image">
                            <img src="./img/herramientas/'.$img.'" alt="'.$title.'">
                        </div>
                        <div class="title">
                            '.$title.'
                        </div>
                        <div class="boton-wrapper">
                        <input type="hidden" name="id" value="'.$id.'">
                        <input type="submit" class="boton" onClick="mensaje()" value="Reservar" name="btnReservar">
                        
                        </div>
                    </div>
                </div>
            </form>
            ';

        }
    } else {


        if($estado[0]['disponible']==0){

        return '
        <!--CARD-->
            <div class="card-wrapper">
                <div class="card">
                    <div class="image">
                        <img src="./img/herramientas/'.$img.'" alt="'.$title.'">
                    </div>
                    <div class="title">
                        '.$title.'
                    </div>
                    <div class="boton-wrapper">
                    <button type="button" class="botonDesactivo" disabled>No Disponible</button>
                    </div>
                </div>
            </div>
        ';
        } else {
        return '
        <!--CARD-->
            <div class="card-wrapper">
                <div class="card">
                    <div class="image">
                        <img src="./img/herramientas/'.$img.'" alt="'.$title.'">
                    </div>
                    <div class="title">
                        '.$title.'
                    </div>
                    <div class="boton-wrapper">
                    <button type="button" class="botonDesactivo" disabled>Disponible</button>
                    </div>
                </div>
            </div>
        ';
        }
    }
    
}

function getContent()
{
    /*CONSEGUIMOS LAS HERREMIENTAS DE BBDD*/
    $query = Connection::executeQuery("select * from herramienta")->fetchAll();
    $cards = '';
    foreach ($query as $tool){
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
    
if(isset($_POST['btnReservar'])){
    //Kint\Kint::dump($_SESSION);
    //Kint\Kint::dump($_POST);
    $estado = Connection::executeQuery('UPDATE `herramienta` SET `disponible` = 0 WHERE `id_herramienta` = "'.$_POST['id'].'";'); 
    $id = $_POST['id'];
    $disponible = Connection::executeQuery('SELECT `disponible` FROM `herramienta` WHERE `id_herramienta` = "'.$id.'";')->fetchAll();
    $estadoHerramienta = $disponible[0]['disponible'];

    if (isset($_SESSION["user"])) {

    $dniUser = $_SESSION["user"]->getDni();
    $nomUser = $_SESSION["user"]->getNombre();
    $apeUser = $_SESSION["user"]->getApellidos();
    $emailUser = $_SESSION["user"]->getEmail();

    Connection::executeQuery("INSERT INTO solicitudalquiler (dni, nombre, apellidos, email, id_herramienta, disponible)
            VALUES ('$dniUser', '$nomUser', '$apeUser', '$emailUser', '$id', '$estadoHerramienta')");
    
    } 
}

getContent();
getFooter($args);