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
        'css/crear_sesion.css',
        'css/inicio_sesion.css',
        'css/guiaDespiecePasoEstilo.css'
    ],
    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
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
                    <div class="row">
                        <div class="col-25">
                            <label for="introducirImagen">Imagen:</label>
                        </div>
                        <div class="col-75">
                            <input type="file" accept="image/*" name="introducirImagen" id="fileIntroducirImagen" required>
                            <!--Validar con js que es una imagen-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="txtIntroducirDetalle">Detalles:</label>
                        </div>
                        <div class="col-75">
                            <textarea name="detalle" id="txtIntroducirDetalle" cols="50" rows="10" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="boton-wrapper">
                    <div class="row">
                        <input type="reset" class="boton" id="botonCancelar" value="Cancelar">
                        <input type="submit" class="boton" id="botonAñadirPaso" formaction="./guiaDespiecePaso.php" value="Añadir paso">
                        <input type="submit" class="boton" id="botonAceptar" value="Aceptar">
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
    $guia->setPasos(array_push($guia->getPasos(), $paso));
    $_SESSION['guia'] = $guia;
    Kint\Kint::dump($_SESSION['guia']);
    Kint\Kint::dump($_POST);
}
getContent();
getFooter($args);

?>