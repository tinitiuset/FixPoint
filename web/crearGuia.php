<?php
require "functions.php";


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

function getContent () {
    Kint\Kint::dump($_SESSION);
    $content= '
<div class="guiaContainer">
    <div class="guiaForm">
        <form action="" method="post" id="crearGuia">
            <label for="nombreMaquina">Nombre de la Maquina:</label>
            <input id="nombreMaquina" name="nombreMaquina" type="text">
            <label for="ocurrencia">Ocurrencia:</label>
            <textarea id="ocurrencia" name="ocurrencia">
            </textarea>
            <label for="propuesta">Propuesta:</label>
            <textarea id="propuesta" name="propuesta">
            </textarea>
            <label for="averias">Averias:</label>
            <textarea id="averias" name="averias">
            </textarea>
            <label for="solucion">Solucion:</label>
            <textarea id="solucion" name="solucion">
            </textarea>    
            <input type="submit" formaction="./paso.php" class="btnCrearCuenta" value="Siguiente">                     
        </form>
    </div>
    <div class="guiaButtons">
    <div class="boton-wrapper">
                <a class="boton" href="">
                Siguiente
                </a>
                </div>        
    
    <div class="boton-wrapper">
                <a class="boton" href="">
                Atras
                </a>
                </div>        
    </div>
</div>
';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);