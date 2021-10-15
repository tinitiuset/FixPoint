<?php
require "functions.php";
$args = [
    'title' => 'Index',
    'styles' => [
        'style.css',
    ],
    'scripts' => [
        'script.js',
    ]
];

function getContent () {
    echo "Content";
}

getHeader($args);
getContent();
getFooter($args);