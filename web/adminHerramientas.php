<?php

use Grupo3\FixPoint\Connection;
use Grupo3\FixPoint\model\herramienta;


require_once "functions.php";


$args = [
    'title' => 'Contacto',
    'styles' => [
        'css/footer.css',
        'css/contacto.css',
        'css/index.css',
        'css/header.css',
        'css/crearHerramienta.css',
        'css/adminHErramientas.css',
        'css/ventanasModales.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/adminHerr.js',
    ]
];

function getContent()
{

    $op = getCrearHerramienta();

    $content = '
    <div class="adminHerrContainer">
        <div class="btnCrearContainer">
            <button type="button" class="collapsible">Crear Herramienta</button>
            <div class="content">
            
                '.$op.'
             </div>
        </div>
        <div class="btnEliminarHerr">
            <button class="collapsible">Eliminar Herramienta</button>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>
    </div>
    ';
    echo $content;
}

function getCrearHerramienta()
{

    /*CONSEGUIMOS LAS CATEGORIAS DE BBDD*/
    $query = Connection::executeQuery("select * from categoria")->fetchAll();
    $options = '';
    $mensajeError = '';
    foreach ($query as $category) {
        $options .= '<option value=' . $category['idCategoria'] . '>' . $category['nombre'] . '</option>';
    }
    /*despues del submit*/

    if (!empty($_POST['name'])) {
        /*Comprobar que no exista esa herramienta*/
        $mensajeError = '';

        $toolName = $_POST['name'];
        $queryToolByName = "select * from herramienta where nombre = '$toolName'";

        $sqlTool = Connection::executeQuery($queryToolByName);

        $rowsInSql = $sqlTool->fetchAll();


        if ($rowsInSql) {
            $mensajeError = '<div class="row"><div class="alert alert-danger" role="alert">
            - Ya existe una herramienta con ese nombre.
                </div></div>';
        } else {
            /*Guardar img y hashearla en img/herramientas */


            $uploaddir = './img/herramientas/';
            $temp = explode(".", $_FILES["image"]["name"]);

            /*time() -> unix timestamp*/

            $newfilename = sha1(time()) . '.' . end($temp);


            move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir.$newfilename);


            $herramienta = new herramienta(
                $toolName,
                $_POST['brand'],
                $_POST['model'],
                true,
                $newfilename,
                $_POST['observations'],
                $_POST['category']
            );


            /*insertar en bbdd*/
            $herramienta->createTool();
            $mensajeError = '<div class="row"><div class="alert alert-danger" role="alert">
            - Herramienta insertada correctamente
                </div></div>';
        }
    }




    $content = '
<div class="containerGeneralCreateTool">

    <h2>Insertar herramienta</h2>

<div class="containerCreateTool">
  <form action="" method="post" enctype="multipart/form-data"> 
    <div class="row">
      <div class="col-25">
        <label for="name">Nombre <span class="cRed">*</span></label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name" placeholder="Maza" pattern=".{0,199}" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="brand">Marca</label>
      </div>
      <div class="col-75">
        <input type="text" id="brand" name="brand" placeholder="Dexter" pattern=".{0,69}">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="model">Model</label>
      </div>
      <div class="col-75">
        <input type="text" id="model" name="model" placeholder="X201" pattern=".{0,69}">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="picture">Imagen de Maquina/Herramienta <span class="cRed">*</span></label>
      </div>
      <div class="col-75" id="imgContainerF">
	    <input type="file" name="image" id="image" accept="image/*" required>
	    <!--validar con js q es una imagen tmb-->
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="category">Categor&iacute;a <span class="cRed">*</span></label>
      </div>
      <div class="col-75">
      
        <select id="category" name="category" required>
          ' . $options . '
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="observations">Obervaciones</label>
      </div>
      <div class="col-75">
        <textarea id="observations" name="observations" pattern=".{0,254}" placeholder="Buen estado en general, herramienta muy pesada"
         ></textarea>
      </div>
    </div>
   
    <div class="row">
      <input type="submit" value="Insertar">
    </div>
  </form>
  '.$mensajeError.'
  <p><span class="cRed">*</span> Campos obligatorios.</p>

</div>
</div>
';
    return $content;
}

getHeader($args);
getContent();
getFooter($args);