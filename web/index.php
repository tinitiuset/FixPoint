<?php

require "functions.php";

$args = [
    'title' => 'Inicio',
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

/*Creo un array multidimensional que contiene la información necesaria para cargar las distintas tarjetas*/ 
$cardContent = [
    [
        'imagen' => './img/ayuda.jpg',
        'titulo' => 'Resuelve problemas',
        'descripcion' => 'Obtenga ayuda para reparar sus herramientas con los manuales de reparación de FixPoint.',
        'enlace' => 'guiasVista.php',
        'btnNombre' => 'Manuales de despiece'
    ], [
        'imagen' => './img/mejorar.jpg',
        'titulo' => 'Mejora FixPoint',
        'descripcion' => 'Ayúdanos a mejorar las guías que otros han comenzado aportando tus conocimientos para completarlos.',
        'enlace' => 'crearGuia.php',
        'btnNombre' => 'Crear guías'
    ], [
        'imagen' => './img/resolver.jpg',
        'titulo' => 'Ayudanos a traducir',
        'descripcion' => '¡Traduzca FixPoint a su lengua materna y ponga la información de reparación a disposición de todos!',
        'enlace' => 'guiasVista.php',
        'btnNombre' => 'Traducir guías'
    ] 
];

function createCard($img = '',$titulo = '',$descripcion = '',$enlace = '',$nombreBoton = ''): string // Función que crea una tarjeta
{
    $cardComunity = '
        <div class="cardComunity-wrapper">
            <div class="cardComunity">
                <div class="imageComunity">
                    <img src="'.$img.'">
                </div>
                <div class="titleHelp">
                    <h3 class="blackTittle">'.$titulo.'</h3>
                    <p>'.$descripcion.'</p>
                </div>
                <div class="botonManuales-wrapper">
                <button class="btnDespiece"><a class="enlacesVistas" href="'.$enlace.'">'.$nombreBoton.'</a></button>
                </div>
            </div>
        </div>';
    return $cardComunity;
}


function getContent($cardContent) // Función que pinta el contenido de la página principal
{
    $cards = '';
    foreach ($cardContent as $card) {
        $cards .= createCard($card['imagen'],$card['titulo'],$card['descripcion'],$card['enlace'],$card['btnNombre']);
    };
    

    $content= '    
    <div class="slideshow-container">
        <div class="slider fade">
        <img src="./img/back01.jpg" id="slider">
            <div class="text">
                <h2 id="titulo">¿Qué es FixPoint?</h2>
                <p class="floatText" id="parrafo">FixPoint es una iniciativa que busca luchar por una economía circular 
                con nuestra <span class=\"bold\">biblioteca de herramientas</span>.</p>
                <button class="btnDonar" id="btnDonar"><a class="enlacesVistas" href="donarHerramientas.php">Donar Herramientas</a></button>
            </div>
        </div>
            <a class="back" id="back">&#10094</a>
            <a class="next" id="next">&#10095</a>
        </div>
        <div class="comunity-container-text-wrapper">
        <div class="comunity-container-text">
        <h2 class="blackTittle">Comunidad FixPoint</h2>
        </div>
    </div>
    <div class="comunity-container-wrapper">
        <div class="comunity-container">
            '.$cards.'
        </div>
    </div>
    <div class="containerMultimedia">
        <div class="multimedia">
            <h2 class="titleCenter">Contribuye con FixPoint</h2>
            <p class="pMultimedia">Nadie sabe cómo arreglar todo, pero todo el mundo sabe cómo arreglar algo.
             Enséñanos lo que sabes y haz que las cosas funcionen durante más tiempo. 
             Cuanto más fácil sea arreglar algo, más gente lo hará.</p>
            <div class="centrado">
                <button class="btnMultimedia">Subir videos</button>
            </div>
        </div>
        <div class="multimediaVideo">
            <iframe id="indexVideo" width="400" height="315" src="https://www.youtube.com/embed/yLU_cSNogF8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args); //=> Cargamos el Header
getContent($cardContent); //=> Cargamos el contenido
getFooter($args); //=> Cargamos el Footer
