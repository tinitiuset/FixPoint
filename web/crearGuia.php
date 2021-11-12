<?php

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
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js'
    ]
];

function getContent()
{
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

getHeader($args);
getContent();
getFooter($args);
