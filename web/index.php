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
    ]
];

function getContent () {

    $content= '
    <div class="slideshow-container">
        <div class="slider fade"> 
            <img src="../web/img/back01.jpg">
            <div class="text">
                <h2>¿Qué es FixPoint?</h2>
                <p>FixPoint es una iniciativa circular sostenible, 
                que busca provocar un cambio en el sistema de sobreproducción, 
                luchando por una economía circular con nuestra 
                biblioteca de herramientas.</p>
            </div>
        </div>
        <div class="slider fade"> 
            <img src="../web/img/back02.jpg">
            <div class="text">
            <h2>¿Qué es una biblioteca de herramientas?</h2>
            <p>FixPoint es una biblioteca como otra cualquiera. Te conviertes 
            en mienbro y después puedes tomar prestadas las herramientas.</p>
            </div>
        </div>
        <div class="slider fade"> 
            <img src="../web/img/back03.jpg">
            <div class="text">
            <h2>¿Cuál es el objetivo de FixPoint?</h2>
            <p>Promover una ciudad más sostenible, mediante el intercambio 
            de herramientas y conocimientos, para alargar la vida útil de las cosas. 
            Puedes ser parte de ésta iniciativa haciendo donación de
            material a nuestra Biblioteca de herramientas.</p>
            </div>
            <button class="btnDonar">Donar Herramientas</button>
        </div>
        <a class="back">&#10094</a>
        <a class="next">&#10095</a>
    </div>';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);