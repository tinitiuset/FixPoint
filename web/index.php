<?php
require "functions.php";
$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/CSS_Header.css',
    ],
    'scripts' => [
        'js/Menu.js',
        'js/slider.js',
    ]
];

function getContent () {

    $content= '
    <div class="slideshow-container">
        <div class="slider fade">
        <img name ="slider" src="../web/img/back01.jpg" id="slider">
            <div class="text">
                <h2>¿Qué es FixPoint?</h2>
                <p>FixPoint es una iniciativa circular sostenible, 
                que busca provocar un cambio en el sistema de sobreproducción, 
                luchando por una economía circular con nuestra 
                biblioteca de herramientas.</p>
            </div>
    </div>
        <button class="btnDonar">Donar Herramientas</button>
        </div>
            <a class="back" id="back">&#10094</a>
            <a class="next" id="next">&#10095</a>
        </div>';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);