<?php

use Grupo3\FixPoint\model\guiaDespiece;
use Mpdf\Mpdf;

require_once "functions.php";
require_once __DIR__ . '/../vendor/autoload.php';


$args = [
    'title' => 'Guia despiece',
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

function getContent()
{
    try {
        /*$guia = new guiaDespiece();*/
        $_POST['id'];
        $content= '';
    } catch (Exception $e) {
        $content= 'No se ha selecionado niguna guia.';
    }
    try {
        $mpdf = new Mpdf([
            'mode' => 'c',
            'tempDir' => __DIR__ . '/pdf'
        ]);

        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    } catch (\Mpdf\MpdfException $e) {
        echo ($e);
    }
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);
