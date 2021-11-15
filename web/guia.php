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
        $content= '
        PRUEBA
        ';
    } catch (Exception $e) {
        $content= 'No se ha selecionado niguna guia.';
    }
    return $content;
}
function pdfForm()
{
    $content= '
            <div>
                <form method="post" action="pdf.php">
                <input type="hidden" name="html" value="'.base64_encode(getContent()).'">
                <label class="formButton"><span> </span><input type="submit" name="accion" formaction="./pdf.php" value="Descargar PDF" /></label>
                </form> 
            </div>
        ';
    echo $content;
}

getHeader($args);
echo(getContent());
pdfForm();
getFooter($args);
