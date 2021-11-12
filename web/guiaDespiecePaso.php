<?php

use Grupo3\FixPoint\model\guiaDespiece;
use Grupo3\FixPoint\model\paso;

require "functions.php";


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
                    <label class="formButton"><span> </span><input type="submit" name="accion" formaction="./guiaDespiecePaso.php" value="Añadir paso" /></label>
                    &nbsp;
                    <label class="formButton"><span> </span><input type="button" id="botonAceptar" name="accion" value="Aceptar"/></label>
                </div>
            </form>
        </div>
    ';

}

getHeader($args);
if (isset($_POST['guia'])) {
    $guia = new guiaDespiece($_POST['fecha'], $_POST['nombreMaquina'], $_POST['ocurrencia'], $_POST['propuesta'], $_POST['averias'], $_POST['solucion']);
    $_SESSION['guia'] = $guia;
}

if (isset($_POST['paso'])) {
    $uploaddir = './img/pasos/';
    $temp = explode(".", $_FILES["fileIntroducirImagen"]["name"]);
    $newfilename = $uploaddir.sha1(time()) . '.' . end($temp);

    $guia = $_SESSION['guia'];
    $paso = new paso($newfilename, $_POST["detalle"], '');

    $pasos = $guia->getPasos();
    array_push($pasos, $paso);
    $guia->setPasos($pasos);
    
    $_SESSION['guia'] = $guia;

    move_uploaded_file($_FILES['fileIntroducirImagen']['tmp_name'], $newfilename);  //Crea las imágenes en la ruta deseada
    // echo var_dump($_SESSION['guia']->getPasos());

}

if (isset($_POST['btnConfirmarPasoAceptar'])) {
    $_SESSION['guia']->createGuiaDespiece();    //Se crea la guía en la base de datos
    $_SESSION['guia']->recogerNumGuiaDeBD();    //Esta función recoge el id (numFicha) de la guía desde la BD, ya que se aplica automaticamente desde ahí y no desde aquí, de lo contrario el valor estaría vacío
    $pasos = $_SESSION['guia']->getPasos();

    foreach ($pasos as $key => $value) {
        $value->setNumGuia($_SESSION['guia']->getNumFicha());   //Se añade el id de la guía a cada paso ya que de lo contrario estarían vacíos
        $value->createPaso();   //Se crea el paso
    }
}

// Kint\Kint::dump($_SESSION['guia']);
getContent();
getFooter($args);

?>