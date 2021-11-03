<?php

use Grupo3\FixPoint\Connection;
use Grupo3\FixPoint\model\guiaDespiecePaso;

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
                        <input type="reset" class="botonGuiaPasoCancelar" id="botonGuiaPasoCancelar" value="Cancelar">
                        <input type="submit" class="botonGuiaPaso" id="botonGuiaPasoAñadir" value="Añadir paso">
                        <input type="submit" class="botonGuiaPaso" id="botonGuiaPasoAceptar" value="Aceptar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    ';

    echo $content;

}

getHeader($args);
getContent();
getFooter($args);

?>