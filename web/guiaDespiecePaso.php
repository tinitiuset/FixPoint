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
        'css/guiaDespiecePasoEstilo.css'
    ],
    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',

    ]
];



function getContent() {

    $arrayGuia = [];

    $content = '
    <section class="containerGeneralPaso">
        <h2>Insertar paso</h2>
        <div class="containerPaso">
            <form action="" method="post" enctype="multipart/form-data">
                <input name="paso" type="hidden" value="1">
                <div class="paso-wrapper">
                    <div class="row-paso">
                        <div class="col-25-paso">
                            <label for="introducirImagen">Imagen:</label>
                        </div>
                        <div class="col-75-paso">
                            <input type="file" accept="image/*" name="fileIntroducirImagen" id="fileIntroducirImagen" required>
                            <!--Validar con js que es una imagen-->
                        </div>
                    </div>
                    <div class="row-paso">
                        <div class="col-25-paso">
                            <label for="txtIntroducirDetalle">Detalles:</label>
                        </div>
                        <div class="col-75-paso">
                            <textarea name="detalle" id="txtIntroducirDetalle" cols="50" rows="10" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="boton-wrapper">
                    <div class="row-paso">
                        <input type="reset" class="boton" id="botonGuiaPasoCancelar" value="Cancelar">
                        <input type="submit" class="boton" id="botonAñadirPaso" formaction="./guiaDespiecePaso.php" value="Añadir paso">
                        <input type="submit" class="boton" name="aceptar" id="botonAceptar" formaction="./guiaDespiecePaso.php" value="Aceptar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    ';

    echo $content;

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