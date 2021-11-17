<?php

use Grupo3\FixPoint\model\GuiaDespiece;
use Grupo3\FixPoint\model\Paso;
use Grupo3\FixPoint\Connection;

require "functions.php";


$args = [
    'title' => 'Añadir paso',
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
                <label id="lblAdvertencia">*Debe añadir al menos un paso para poder aceptar.</label><br>
                <div class="formButtons">
                    <label class="formButton"><span> </span><input type="submit" formaction="./crearGuia.php" value="Reiniciar" formnovalidate /></label>
                    &nbsp;
                    <label class="formButton"><span> </span><input type="submit" name="accion" formaction="./Paso.php" value="Añadir paso" /></label>
                    &nbsp;
                    <label class="formButton"><span> </span><input type="button"';
                    if (count($_SESSION['guia']->getPasos()) === 0) {
                        $content .= 'disabled';
                    }
                    $content .= '
                    id="botonAceptar" name="accion" value="Aceptar"/></label>
                </div>
            </form>
        </div>
    </div>
    ';
    echo $content;
}

//Aquí detectará si el nombre dado a la guía está en uso, y de ser así, te reenviará a la página "crearGuia"
//ESTÁ ENCIMA DEL "getHeader" PORQUE DE LO CONTRARIO NO DEJARÍA REENVIAR MODIFICANDO LA URL
//Se recogen los nombres de todas las guías creadas
$query = Connection::executeQuery("SELECT nombreMaquina FROM guiadespiece")->fetchColumn();
//Se recoge la cantidad de guías creadas
$cantidad = Connection::executeQuery("SELECT COUNT(*) FROM guiadespiece")->rowCount();
//Se recorren todas las guías buscando si el nombre dado se repite
for ($i=0; $i < $cantidad; $i++) { 
    if ($_POST['nombreMaquina'] === isset($query[$i])) {
        //Te devuelve a "crearGuia"
        header("Location: ../web/crearGuia.php");
        exit();
    }
}

getHeader($args);

if (isset($_POST['guia'])) {
    $guia = new GuiaDespiece(
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

    $paso = new Paso($newfilename, $_POST["detalle"], '');

    $pasos = $_SESSION['guia']->getPasos();
    array_push($pasos, $paso);
    $_SESSION['guia']->setPasos($pasos);

    //Crea las imágenes en la ruta deseada
    move_uploaded_file($_FILES['fileIntroducirImagen']['tmp_name'], $newfilename);
}

if (isset($_POST['btnConfirmarPasoAceptar'])) {
    if (isset($_SESSION["user"])) {
        //Se crea la guía en la base de datos
        $_SESSION['guia']->createGuiaDespiece();

        //Esta función recoge el id (numFicha) de la guía desde la BD,
        // ya que se aplica automaticamente desde ahí y no desde aquí,
        // de lo contrario el valor estaría vacío
        $_SESSION['guia']->recogerNumGuiaDeBD();
        
        $dniUser = $_SESSION["user"]->getDni();
        $numFicha = $_SESSION['guia']->getNumFicha();

        Connection::executeQuery("INSERT INTO creadorguia (dni, numFicha)
            VALUES ('$dniUser', '$numFicha')");

        $pasos = $_SESSION['guia']->getPasos();

        foreach ($pasos as $key => $value) {

            //Se añade el id de la guía a cada paso, ya que de lo contrario estarían vacíos
            $value->setNumGuia($_SESSION['guia']->getNumFicha());

            //Se crea el paso con su correspondiente numero --
            $value->createPaso($key+1);


        }

        //Script para redireccionar a la pagina de guias
        //No puedo redireccionar con el header ya que lo hemos utilizado en functions
        echo "<script> window.location='guiasVista.php'; </script>";
    } else {
        $mensaje = "Debe iniciar sesión para crear la guía.";
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
    }

}

getContent();
getFooter($args);
