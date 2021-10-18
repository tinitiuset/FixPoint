<?php
require "functions.php";
$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
    ],
    'scripts' => [
        'js/script.js',
    ]
];

function getContent () {

    $content= '
    <div> 
    
    </div>';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);