<?php
require "functions.php";
$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/header.css',
    
    ],
    'scripts' => [
        'js/menu.js',
    ]
];

function getContent () {

    $content= '
    <div class="container-contact">
        
    </div>';
    echo $content;
}
getHeader($args);
getContent();
getFooter($args);