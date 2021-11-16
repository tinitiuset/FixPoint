<?php
require_once "model/User.php";

use Grupo3\FixPoint\model\User;
use Grupo3\FixPoint\Connection;

require "functions.php";

$args = [
    'title' => 'Crear manual',
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
    //Comprobamos que el usuario esté logueado para poder crear una guía
    if (!isset($_SESSION['user'])) {
    echo'
    <div class="modalConfirmarGuia" id="modalConfirmarGuia">
        <div class="modalContenidoConfirmar">
            <div class="modalHeaderConfirmar">
                <h1 id="tituloConfirmarGuia">Necesitas estar registrado para crear una guía</h1>
            </div>
            <form action="" method="post">
                <div class=botones>
                    <input type="submit" id="btnAceptarGuia"  formaction="./index.php" name="btnConfirmarPasoAceptar" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
    <div class="guiaContainer">
            <div class="form-style">
                <div class="form-style-heading">Crear una guia</div>
                    <form action="" method="post" id="crearGuia">
                        <input name="guia" type="hidden" value="1">
                        <input name="fecha" type="hidden" value="' . time() . '">
                        <label for="field1"><span>Nombre de la maquina <span class="required">*</span></span><input type="text" class="input-field" name="nombreMaquina" value="" required/></label>
                        
                        <label for="field2"><span>Ocurrencia <span class="required">*</span></span><textarea name="ocurrencia" class="textarea-field" required></textarea></label>
                        <label for="field3"><span>Propuesta <span class="required">*</span></span><textarea name="propuesta" class="textarea-field" required></textarea></label>
                        <label for="field4"><span>Averias <span class="required">*</span></span><textarea name="averias" class="textarea-field" required></textarea></label>
                        <label for="field5"><span>Solucion <span class="required">*</span></span><textarea name="solucion" class="textarea-field" required></textarea></label>
                        <div class="formButtons">
                            <label class="formButton"><span> </span><input type="submit" formaction="./guiaDespiecePaso.php" value="Siguiente" /></label>
                            &nbsp;
                            <label class="formButton"><span> </span><input type="reset" value="Reiniciar" /></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    } else {
        echo '
        <div class="guiaContainer">
            <div class="form-style">
                <div class="form-style-heading">Crear una guia</div>
                    <form action="" method="post" id="crearGuia">
                        <input name="guia" type="hidden" value="1">
                        <input name="fecha" type="hidden" value="' . time() . '">
                        <label for="field1"><span>Nombre de la maquina <span class="required">*</span></span><input type="text" class="input-field" name="nombreMaquina" value="" required/></label>
                        
                        <label for="field2"><span>Ocurrencia <span class="required">*</span></span><textarea name="ocurrencia" class="textarea-field" required></textarea></label>
                        <label for="field3"><span>Propuesta <span class="required">*</span></span><textarea name="propuesta" class="textarea-field" required></textarea></label>
                        <label for="field4"><span>Averias <span class="required">*</span></span><textarea name="averias" class="textarea-field" required></textarea></label>
                        <label for="field5"><span>Solucion <span class="required">*</span></span><textarea name="solucion" class="textarea-field" required></textarea></label>
                        <div class="formButtons">
                            <label class="formButton"><span> </span><input type="submit" formaction="./guiaDespiecePaso.php" value="Siguiente" /></label>
                            &nbsp;
                            <label class="formButton"><span> </span><input type="reset" value="Reiniciar" /></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }
}

getHeader($args);
getContent();
getFooter($args);
