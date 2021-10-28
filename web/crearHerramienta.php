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

/*despues del submit*/

    /*Comprobar que no exista esa herramienta*/

    /*Guardar img y hashearla en img/herramientas */

    /*insertar en bbdd*/

function getContent () {

    /*CONSEGUIMOS LAS HERREMIENTAS DE BBDD*/
    $query = Connection::executeQuery("select * from categoria")->fetchAll();
    $options = '';
    foreach ($query as $category){
        $options .= '<option value='.$category['idCategoria'].'>'.$category['nombre'].'</option>';
    }


    $content= '
<div class="containerGeneralCreateTool">

    <h2>Insertar herramienta</h2>

<div class="containerCreateTool">
  <form action="/action_page.php">
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
        <input type="text" id="brand" placeholder="Dexter" pattern=".{0,69}">
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
          '.$options.'
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
  <p><span class="cRed">*</span> Campos obligatorios.</p>

</div>
</div>
';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);