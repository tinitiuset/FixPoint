<?php

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

$cardContent = [
    [
        'imagen' => './img/ayuda.jpg',
        'titulo' => 'Resuelve problemas',
        'descripcion' => 'Obtenga ayuda para reparar sus herramientas con los manuales de reparación de FixPoint.',
        'btnNombre' => 'Manuales de despiece'
    ], [
        'imagen' => './img/mejorar.jpg',
        'titulo' => 'Mejora FixPoint',
        'descripcion' => 'Ayúdanos a mejorar las guías prácticas que otros han comenzado aportando tus conocimientos para completarlos.',
        'btnNombre' => 'Crear guías'
    ], [
        'imagen' => './img/resolver.jpg',
        'titulo' => 'Ayudanos a traducir',
        'descripcion' => '¡Traduzca FixPoint a su lengua materna y ponga la información de reparación a disposición de todos!',
        'btnNombre' => 'Traducir guías'
    ] 
];

function createCard($img = '',$titulo = '',$descripcion = '',$nombreBoton = ''): string
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
                <button class="btnDespiece">'.$nombreBoton.'</button>
                </div>
            </div>
        </div>';
    return $cardComunity;
}


function getContent($cardContent)
{
    $cards = [];
    foreach ($cardContent as $card) {
        $cardComunity = createCard($card['imagen'],$card['titulo'],$card['descripcion'],$card['btnNombre']);
        array_push($cards,$cardComunity);
    };
    

    $content= '    
    <div class="slideshow-container">
        <div class="slider fade">
        <img src="./img/back01.jpg" id="slider">
            <div class="text">
                <h2 id="titulo">¿Qué es FixPoint?</h2>
                <p class="floatText" id="parrafo">FixPoint es una iniciativa que busca luchar por una economía circular 
                con nuestra <span class=\"bold\">biblioteca de herramientas</span>.</p>
                <button class="btnDonar" id="btnDonar">Donar Herramientas</button>
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
            '.$cards[0].'
            '.$cards[1].'
            '.$cards[2].'
        </div>
    </div>
    <div class="containerMultimedia">
        <div class="multimedia">
            <h2>Contribuye con FixPoint</h2>
            <p>Nadie sabe cómo arreglar todo, pero todo el mundo sabe cómo arreglar algo.
             Enséñanos lo que sabes y haz que las cosas funcionen durante más tiempo. 
             Cuanto más fácil sea arreglar algo, más gente lo hará.</p>
            <button class="btnMultimedia">Subir videos</button>
        </div>
        <div>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/yLU_cSNogF8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent($cardContent);
getFooter($args);
