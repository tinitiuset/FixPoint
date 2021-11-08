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
        'css/guiaDespiecePasoEstilo.css',
        'css/crear_sesion.css',
        'css/inicio_sesion.css',
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
    <form action="" method="post" id="crearGuia">
        <input name="paso" type="hidden" value="1">
        <label for="field1"><span>Imagen <span class="required">*</span></span><input type="file" accept="image/*" name="introducirImagen" id="fileIntroducirImagen" required/></label>
        
        <label for="field2"><span>Detalles <span class="required">*</span></span><textarea name="detalle" id="txtIntroducirDetalle" class="textarea-field" required></textarea></label>
        
        <div class="formButtons">
            <label class="formButton"><span> </span><input type="submit" formaction="./crearGuia.php" value="Reiniciar" formnovalidate /></label>
            &nbsp;
            <label class="formButton"><span> </span><input type="submit" formaction="./guiaDespiecePaso.php" value="Añadir paso" /></label>
            &nbsp;
            <label class="formButton"><span> </span><input type="submit" formaction="./controlarPaso.php" value="Aceptar"/></label>
        </div>
    </form>
</div>
';

}

getHeader($args);
if (isset($_POST['guia'])) {
    $guia = new guiaDespiece($_POST['fecha'], $_POST['nombreMaquina'], $_POST['ocurrencia'], $_POST['propuesta'], $_POST['averias'], $_POST['solucion']);
    $_SESSION['guia'] = $guia;
} elseif (isset($_POST['paso'])){
    $paso = new paso('','','','');
    $guia = $_SESSION['guia'];
   
    $pasos = $guia->getPasos();
    array_push($pasos, $paso);
    $guia->setPasos($pasos);
    
    $_SESSION['guia'] = $guia;
}
Kint\Kint::dump($_SESSION['guia']);

if (isset($_POST["aceptar"])) {
    crearGuia();
}
getContent();
getFooter($args);

function crearGuia() {
    $uploaddir = './img/pasos/';
    $temp = explode(".", $_FILES["fileIntroducirImagen"]["name"]);

    /*time() -> unix timestamp*/

    $newfilename = $uploaddir.sha1(time()) . '.' . end($temp);

    move_uploaded_file($_FILES['introducirImagen']['tmp_name'], $newfilename);
}

?>