<?php
require "functions.php";

use Grupo3\FixPoint\Connection;


$args = [
    'title' => 'Index',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/crearHerramienta.css',
        'css/crear_sesion.css',
        'css/inicio_sesion.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
    ]
];



function getContent()
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


            $uploaddir = 'img/herramientas/';
            $uploadfile = $uploaddir . basename($_FILES['image']['name']);

            $temp = explode(".", $_FILES["image"]["name"]);

            /*time() -> unix timestamp*/

            $newfilename = sha1(time()) . '.' . end($temp);


            move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir.$newfilename);


            $herramienta = new Grupo3\FixPoint\model\herramienta(
                $toolName,
                $_POST['brand'],
                $_POST['model'],
                true,
                $newfilename,
                $_POST['observations'],
                $_POST['category']
            );


            /*insertar en bbdd*/
            $herramienta.createTool();
            $mensajeError = '<div class="row"><div class="alert alert-danger" role="alert">
            - Herramienta insertada correctamente
                </div></div>';
        }
    }




    $content = '
<div class="containerGeneralCreateTool">

    <h2>Insertar herramienta</h2>

<div class="containerCreateTool">
  <form action="crearHerramienta.php" method="post" enctype="multipart/form-data"> 
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
        <input type="text" id="model" placeholder="X201" pattern=".{0,69}">
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
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);