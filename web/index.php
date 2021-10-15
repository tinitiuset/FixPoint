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
    echo "Content";
}

getHeader($args);
getContent();
getFooter($args);