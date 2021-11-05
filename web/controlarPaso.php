<?php

use Grupo3\FixPoint\model\guia;
use Grupo3\FixPoint\model\paso;

$arrayPaso = [];
$cantidadPasos = 0;

if (isset($_POST["btnGuiaPaso"]) == "Añadir paso") {
    $paso = new paso($_POST["introducirImagen"], $_POST["detalle"], $cantidadPasos + 1, null);
    $arrayPaso[$cantidadPasos] = $paso;
}

if (isset($_POST["btnGuiaPaso"]) == "Aceptar") {
    
}

?>