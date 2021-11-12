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
        'js/logout.js'
    ]
];

function getContent()
{
    $content = '
    <div class="guiaContainer">
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
    </div>
    ';
    echo $content;
}

getHeader($args);

if (isset($_POST['guia'])) {
    $guia = new guiaDespiece(
        $_POST['fecha'],
        $_POST['nombreMaquina'],
        $_POST['ocurrencia'],
        $_POST['propuesta'],
        $_POST['averias'],
        $_POST['solucion']
    );
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
    //Crea las imágenes en la ruta deseada
    move_uploaded_file($_FILES['fileIntroducirImagen']['tmp_name'], $newfilename);
}

if (isset($_POST['btnConfirmarPasoAceptar'])) {
    //Se crea la guía en la base de datos
    $_SESSION['guia']->createGuiaDespiece();
    //Esta función recoge el id (numFicha) de la guía desde la BD,
    // ya que se aplica automaticamente desde ahí y no desde aquí,
    // de lo contrario el valor estaría vacío
    $_SESSION['guia']->recogerNumGuiaDeBD();
    $pasos = $_SESSION['guia']->getPasos();
    foreach ($pasos as $key => $value) {
        //Se añade el id de la guía a cada paso ya que de lo contrario estarían vacíos
        $value->setNumGuia($_SESSION['guia']->getNumFicha());
        $value->createPaso();   //Se crea el paso
    }
}

getContent();
getFooter($args);
