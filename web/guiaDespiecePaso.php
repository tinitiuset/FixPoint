<?php

use Grupo3\FixPoint\model\guiaDespiece;
use Grupo3\FixPoint\model\paso;

require_once "functions.php";


$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
        'css/crearGuia.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',

    ]
];



function getContent() {

    $content = '
    <div class="guiaContainer">
        '. form().'
    </div>
    ';

    echo $content;

}

function form()
{
    return '
        <div class="form-style">
            <div class="form-style-heading">Añadir un Paso</div>
            <form action="" method="POST" enctype="multipart/form-data" id="crearGuia" >
                <input name="paso" type="hidden" value="1">
                <label for="field1"><span>Imagen <span class="required">*</span></span><input type="file" accept="image/*" name="fileIntroducirImagen" id="fileIntroducirImagen" required/></label>
                
                <label for="field2"><span>Detalles <span class="required">*</span></span><textarea name="detalle" id="txtIntroducirDetalle" class="textarea-field" required></textarea></label>
                
                <div class="formButtons">
                    <label class="formButton"><span> </span><input type="submit" formaction="./crearGuia.php" value="Reiniciar" formnovalidate /></label>
                    &nbsp;
                    <label class="formButton"><span> </span><input type="submit" formaction="./guiaDespiecePaso.php" value="Añadir paso" /></label>
                    &nbsp;
                    <label class="formButton"><span> </span><input type="submit" onClick="crearGuia()" name="aceptar" value="Aceptar"/></label>
                </div>
            </form>
        </div>
    ';

}

getHeader($args);
$_SESSION["imagenes"] = array();
if (isset($_POST['guia'])) {
    $guia = new guiaDespiece($_POST['fecha'], $_POST['nombreMaquina'], $_POST['ocurrencia'], $_POST['propuesta'], $_POST['averias'], $_POST['solucion']);
    $_SESSION['guia'] = $guia;
} elseif (isset($_POST['paso'])) {
    $uploaddir = './img/pasos/';
    
    $temp = explode(".", $_FILES["fileIntroducirImagen"]["name"]);

    /*time() -> unix timestamp*/
    $newfilename = $uploaddir.sha1(time()) . '.' . end($temp);

    // array_push($arrayImagenes, array($_FILES['fileIntroducirImagen']['tmp_name'], $newfilename));

    $paso = new paso($newfilename, $_POST["detalle"], '', '');
    $guia = $_SESSION['guia'];
   
    $pasos = $guia->getPasos();
    array_push($pasos, $paso);
    $guia->setPasos($pasos);
    
    $_SESSION['guia'] = $guia;
    
    echo var_dump($_SESSION['imagenes']);
    $_SESSION['imagenes'][] = array($_FILES['fileIntroducirImagen']['tmp_name'], $newfilename);

    // echo var_dump($arrayImagenes);
    echo var_dump($_SESSION['imagenes']);
}
// Kint\Kint::dump($_SESSION['guia']);

if (isset($_POST["aceptar"])) {
    crearGuia();
}
getContent();
getFooter($args);

function crearGuia() {
    echo 'entra en la función';
    
    for ($contador = 0; $contador < count($_SESSION["imagenes"]); $contador++) {
        move_uploaded_file($_SESSION["imagenes"][$contador][0], $_SESSION["imagenes"][$contador][1]);
        // echo $value->getFoto() . '<br>';
    }
    // echo var_dump($_SESSION["imagenes"]);
}

?>