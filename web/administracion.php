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
        'css/administracion.css',
        'css/ventanasModales.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/administracion.js',
        'js/logout.js',

    ]
];

function getContent()
{

    $op = getCrearHerramienta();
    $opTwo = getEliminarHerramienta();
    $opTres = getActivarUsuario();
    $opCuatro = getEliminarUsuario();
    $opCinco = getAdministrarAlquiler();
    $opSeis = getActivarAlquilerHerramienta();

    $content = '
    <div class="adminHerrContainer">
    <h2>Administracion de herramientas</h2>
        <div class="btnCrearContainer">
            <button type="button" class="collapsible">Crear Herramienta</button>
            <div class="content">
            
                '.$op.'
             </div>
        </div>
        <div class="btnEliminarHerr">
            <button class="collapsible">Eliminar Herramienta</button>
            <div class="content overfl">
                '.$opTwo.'            
            </div>
        </div>
        <div class="btnActivarAlquiler">
            <button class="collapsible">Activar Alquiler Herramienta</button>
            <div class="content overfl">
                '.$opSeis.'            
            </div>
        </div>
    <h2>Administracion de Usuarios</h2>
        <div class="btnCrearContainer">
            <button type="button" class="collapsible">Activar Usuario</button>
            <div class="content">
            
                '.$opTres.'
             </div>
        </div>
        <div class="btnEliminarHerr">
            <button class="collapsible">Eliminar Usuario</button>
            <div class="content overfl">
                '.$opCuatro.'            
            </div>
        </div>
    <h2>Administracion de alquileres</h2>
        <div class="btnCrearContainer">
            <button type="button" class="collapsible">Gestión de Alquiler</button>
            <div class="content">
            
                '.$opCinco.'
             </div>
        </div>
    </div>
    ';
    echo $content;
}

function getEliminarHerramienta()
{
    /*CONSEGUIMOS LAS HERRAMIENTAS DE BBDD*/
    $query = Connection::executeQuery("select * from herramienta")->fetchAll();
    $tools = '';
    $mensajeEliminarHerramienta = '';



    /*despues del submit*/
    if (isset($_POST["checkbox"])){
        if($_POST["checkbox"]) {
            foreach($_POST["checkbox"] as $value)
            {
                /*Eliminar fotos*/
                $getfoto = Connection::executeQuery('SELECT * from `herramienta` where `id_herramienta` = '.$value.';')->fetchAll();
                unlink('./img/herramientas/'.$getfoto[0]['foto']);


                /*Eliminar filas*/
                Connection::executeQuery('DELETE FROM `herramienta` WHERE `id_herramienta` = '.$value.';');

                /*Refrescamos*/
                $query = Connection::executeQuery("select * from herramienta")->fetchAll();

                $mensajeEliminarHerramienta = '<div class="row"><div class="alert alert-danger" role="alert">
            - usuario eliminado correctamente
                </div></div>';



            }

        }
    }


    foreach ($query as $tool) {
        $idCategoria = $tool['idCategoria'];
        $queryCategory = Connection::executeQuery('SELECT * FROM `categoria` WHERE `idcategoria`='.$idCategoria.';')->fetchAll();

        $tools .= '
            <tr>
                <td>'.$tool['id_herramienta'].'</td>
                <td>'.$tool['nombre'].'</td>
                <td>'.$tool['modelo'].'</td>
                <td>'.$tool['marca'].'</td>
                <td>'.$tool['observaciones'].'</td>
                <td>'.$queryCategory[0]['nombre'].'</td>
                <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="'.$tool['id_herramienta'].'"></td>
            </tr>
        ';
    }

    $content = '
    <form action="" method="post">
    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Observaciones</th>
            <th>Categoria</th>
            <th>Seleccionar</th>
        </tr>
        '.$tools.'
    </table><br>
          <input type="submit" value="Eliminar">
    '.$mensajeEliminarHerramienta.'
    </form>

';
    return $content;
}

function getActivarAlquilerHerramienta()
{
    /*CONSEGUIMOS LAS HERRAMIENTAS DE BBDD*/
    $query = Connection::executeQuery("select * from herramienta")->fetchAll();
    $tools = '';
    $mensajeActivarHerramienta = '';



    /*despues del submit*/
    if (isset($_POST["checkboxDisponible"])){
        if($_POST["checkboxDisponible"]) {
            foreach($_POST["checkboxDisponible"] as $value)
            {
                $estado = Connection::executeQuery('SELECT `disponible` FROM `herramienta` WHERE `id_herramienta` = "'.$value.'";')->fetchAll();
                    
                    if($estado[0]['disponible']==0){
                       /* Activar usuario*/
                        Connection::executeQuery('UPDATE `herramienta` SET `disponible` = 1 WHERE `id_herramienta` = "'.$value.'";'); 

                        /*refrescamos*/
                        $query = Connection::executeQuery("select * from herramienta")->fetchAll();

                        $mensajeActivarHerramienta = '<div class="row"><div class="alert alert-danger" role="alert">
                        Disponibilidad activada correctamente
                        </div></div>';   
                    }

                }

        }
    }


    foreach ($query as $tool) {
        
        $tools .= '
            <tr>
                <td>'.$tool['id_herramienta'].'</td>
                <td>'.$tool['nombre'].'</td>
                <td>'.$tool['modelo'].'</td>
                <td>'.$tool['marca'].'</td>
                <td>'.$tool['disponible'].'</td>
                <td><input type="checkbox" name="checkboxDisponible[]" id="checkboxDisponible[]" value="'.$tool['id_herramienta'].'"></td>
            </tr>
        ';
    }

    $content = '
    <form action="" method="post">
    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Disponible</th>
            <th>Seleccionar</th>
        </tr>
        '.$tools.'
    </table><br>
          <input type="submit" value="Activar">
    '.$mensajeActivarHerramienta.'
    </form>

';
    return $content;
}

function getEliminarUsuario()
    {
        /*CONSEGUIMOS LOS DE BBDD*/
        $query = Connection::executeQuery("select * from usuario")->fetchAll();
        $usuarios = '';
        $mensajeEliminarUsuario = '';


        /*despues del submit*/
        if (isset($_POST["checkboxUsuario"])){
            if($_POST["checkboxUsuario"]) {
                foreach($_POST["checkboxUsuario"] as $value)
                {
                    /*Eliminar filas*/
                    Connection::executeQuery('DELETE FROM `usuario` WHERE `dni` = "'.$value.'";');


                    /*refrescamos*/
                    $query = Connection::executeQuery("select * from usuario")->fetchAll();

                    $mensajeEliminarUsuario = '<div class="row"><div class="alert alert-danger" role="alert">
            - usuario eliminado correctamente
                </div></div>';

                }
    
            }
        }
    
        foreach ($query as $usuario) {


            $usuarios .= '
                <tr>
                    <td>'.$usuario['dni'].'</td>
                    <td>'.$usuario['nombre'].'</td>
                    <td>'.$usuario['apellidos'].'</td>
                    <td>'.$usuario['email'].'</td>
                    <td><input type="checkbox" name="checkboxUsuario[]" id="checkboxUsuario[]" value="'.$usuario["dni"].'"></td>
                </tr>
            ';
        }

        $content = '
        <form action="administracion.php" method="post">
        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Seleccionar</th>
            </tr>
            '.$usuarios.'
        </table><br>
              <input type="submit" value="Eliminar">
        
        </form>
        '.$mensajeEliminarUsuario.'
    
    ';
        return $content;
    }


function getActivarUsuario()
    {
        /*CONSEGUIMOS LOS DE BBDD*/
        $query = Connection::executeQuery("select * from usuario")->fetchAll();
        $usuarios = '';
        $mensajeActivarUsuario = '';


        /*despues del submit*/
        if (isset($_POST["checkboxUsuarioActivo"])){
            if($_POST["checkboxUsuarioActivo"]) {
                foreach($_POST["checkboxUsuarioActivo"] as $value)
                {
                    
                    $estado = Connection::executeQuery('SELECT `activo` FROM `usuario` WHERE `dni` = "'.$value.'";')->fetchAll();
                    
                    if($estado[0]['activo']==0){
                       /* Activar usuario*/
                        Connection::executeQuery('UPDATE `usuario` SET `activo` = 1 WHERE `dni` = "'.$value.'";'); 

                        /*refrescamos*/
                        $query = Connection::executeQuery("select * from usuario")->fetchAll();

                        $mensajeActivarUsuario = '<div class="row"><div class="alert alert-danger" role="alert">
                        usuario activado correctamente
                        </div></div>';   
                    } else {
                     
                    /* Desactivar usuario*/
                    Connection::executeQuery('UPDATE `usuario` SET `activo` = 0 WHERE `dni` = "'.$value.'";');
                    
                    /*refrescamos*/
                    $query = Connection::executeQuery("select * from usuario")->fetchAll();

                    $mensajeActivarUsuario = '<div class="row"><div class="alert alert-danger" role="alert">
                    usuario desactivado correctamente
                    </div></div>';
                    }

                }
    
            }
        }
    
        foreach ($query as $usuario) {


            $usuarios .= '
                <tr>
                    <td>'.$usuario['dni'].'</td>
                    <td>'.$usuario['nombre'].'</td>
                    <td>'.$usuario['apellidos'].'</td>
                    <td>'.$usuario['email'].'</td>
                    <td>'.$usuario['activo'].'</td>
                    <td><input type="checkbox" name="checkboxUsuarioActivo[]" id="checkboxUsuarioActivo[]" value="'.$usuario["dni"].'"></td>
                </tr>
            ';
        }

        $content = '
        <form action="administracion.php" method="post">
        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Activar/Desactivar</th>
            </tr>
            '.$usuarios.'
        </table><br>
              <input type="submit" value="Cambiar Estado">
        </form>
        '.$mensajeActivarUsuario.'
    
    ';
        return $content;
    }

function getAdministrarAlquiler()
{
    
        /*CONSEGUIMOS LOS DE BBDD*/
        $query = Connection::executeQuery("select s.dni, S.nombre, S.apellidos, S.email, S.id_herramienta, S.disponible, S.alquiler_atendido, A.fechaInicio, A.fechaFin from solicitudalquiler S JOIN alquiler A ON S.id_herramienta = A.id_herramienta")->fetchAll();
        $alquileres = '';
        $mensajeAlquilerGestionado = '';
        
        /*despues del submit*/
        if (isset($_POST["checkboxAlquilerAtendido"])){
            if($_POST["checkboxAlquilerAtendido"]) {
                foreach($_POST["checkboxAlquilerAtendido"] as $value)
                {
                   
                    $estado = Connection::executeQuery('SELECT `alquiler_atendido` FROM `solicitudalquiler` WHERE `id_herramienta` = "'.$value.'";')->fetchAll();
                    
                    if($estado[0]['alquiler_atendido']==0){
                       /* Alquiler atendido*/
                        Connection::executeQuery('UPDATE `solicitudalquiler` SET `alquiler_atendido` = 1 WHERE `id_herramienta` = "'.$value.'";'); 

                        /*refrescamos*/
                        $query = Connection::executeQuery("select s.dni, S.nombre, S.apellidos, S.email, S.id_herramienta, S.disponible, S.alquiler_atendido, A.fechaInicio, A.fechaFin from solicitudalquiler S JOIN alquiler A ON S.id_herramienta = A.id_herramienta")->fetchAll();

                        $mensajeAlquilerGestionado = '<div class="row"><div class="alert alert-danger" role="alert">
                        alquiler activado correctamente
                        </div></div>';   
                    } else {
                     
                    /* Desactivar alquiler*/
                    Connection::executeQuery('UPDATE `solicitudalquiler` SET `alquiler_atendido` = 0 WHERE `id_herramienta` = "'.$value.'";'); 
                   
                    
                    /*refrescamos*/
                    $query = Connection::executeQuery("select s.dni, S.nombre, S.apellidos, S.email, S.id_herramienta, S.disponible, S.alquiler_atendido, A.fechaInicio, A.fechaFin from solicitudalquiler S JOIN alquiler A ON S.id_herramienta = A.id_herramienta")->fetchAll();

                    $mensajeAlquilerGestionado = '<div class="row"><div class="alert alert-danger" role="alert">
                    alquiler desactivado correctamente
                    </div></div>';
                    }

                }
    
            }
        }
    
        foreach ($query as $alquiler) {


            $alquileres.= '
                <tr>
                    <td>'.$alquiler['dni'].'</td>
                    <td>'.$alquiler['nombre'].'</td>
                    <td>'.$alquiler['apellidos'].'</td>
                    <td>'.$alquiler['email'].'</td>
                    <td>'.$alquiler['id_herramienta'].'</td>
                    <td>'.$alquiler['disponible'].'</td>
                    <td>'.$alquiler['alquiler_atendido'].'</td>
                    <td><input type="checkbox" name="checkboxAlquilerAtendido[]" id="checkboxAlquilerAtendido[]" value="'.$alquiler["id_herramienta"].'"></td>
                    <td><input type="date" name=fechaInicio value="'.$alquiler["fechaInicio"].'"></td>
                    <td><input type="date" name=fechaFin value="'.$alquiler["fechaFin"].'"></td>
                    
                </tr>
            ';
        }

        $content = '
        <form action="administracion.php" method="post">
        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Id_Herramienta</th>
                <th>Disponibilidad</th>
                <th>AlquilerAtendido</th>
                <th>Activar/Desactivar</th>
                <th>FechaInicio</th>
                <th>FechaFin</th>
            </tr>
            '.$alquileres.'
        </table><br>
              <input type="submit" value="Actualizar Datos">
        </form>
        '.$mensajeAlquilerGestionado.'
    
    ';
        return $content;
    
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