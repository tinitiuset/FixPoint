<?php
use Grupo3\FixPoint\Connection;
use Grupo3\FixPoint\model\User;

require_once "./model/User.php";


function getHeader($headerArgs = null): void
{
    session_start();
    $structure = '

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <!-- Comprobar metas
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <title>' . $headerArgs['title'] . '</title>    
    ';
    foreach ($headerArgs['styles'] as $style) {
        $structure .= '<link rel="stylesheet" href="'.$style.'">';
    }
    foreach ($headerArgs['scripts'] as $script) {
        $structure .= '<script src="' . $script . '"></script> ';
    }
    $structure .= '
    </head>
    <body>
    ';
    $structure .= navbar();
    $structure .= crearUsuario();
    $structure .= iniciarSesion();
    echo($structure);
}

function navbar(): string
{
    $structureNavBar = '
    <header>
    <div class="container">
        <a class="logo" href="index.php"><img src="./img/LogoFix-250px.png" alt="FixPoint LOGO"></a>
    </div>
    <nav id="site-nav" class="site-nav">
        <div class="catalogo"><a href="productos.php">Catálogo</a></div>
        <div class="Guías"><a href="">Guías despiece</a></div>
        <div class="Donar"><a href="">Donar herramientas</a></div>
        <div class="Contacto"><a id="iniciarSesionTablet" href="contacto.php">Contacto <i class="fas fa-envelope"></i></a></div>
        <div class="Login" id="Login">
    ';
    if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
        $structureNavBar .= '
            <a class="imgUsuario" href="#"><img src="./img/user.png" alt="usuario"></a>
        ';
    } else {
        $structureNavBar .= '
            <div class="Login-a"><a id="unirse" href="#">Unete</a></div>
            <div class="icon-bar"></div>
            <div class="Login-a"><a id="iniciarSesion" href="#">Iniciar Sesión</a></div>
        ';
    }

    $structureNavBar .= '
            </div>
        </nav>
        <div  class="iconoLogin"><a href=""><i class="far fa-user"></i></a></div>
        <div id="menu-toggle" class="menu-toggle"> <!-- Usamos javascript nativo por lo que añadimos un evento
        en nuestro caso onClick que llama al menu.js-->
            <div class="hamburger"></div>
        </div>
    </header>
    ';

    return $structureNavBar;
}

function crearUsuario(): string
{
    /* Logica para mostrar el mensaje que devuelve la funcionalidad de registro*/
    $errMessage = '';
    if (isset($_POST['apellidos'])){
        $errMessage = '
        <div class="alert alert-danger" role="alert">
        '.handleRegister($_POST).'
                </div>';
    }


    return '
    <!-- Modal creación de usuario -->
    <div class="modalCrearSesion" id="modal">
        <div class="modalContenidoCrear">
            <div class="modalHeaderCrear">
                <span class="cerrar">&times;</span>
                <h1 id="tituloCrear">Crear Cuenta</h1>
                <p>¿Has estado aquí antes? <a href="http://">Inicia sesión</a></p>
            </div>
            <div class="modalBodyCrear">
                <form action="" method="post" id="formularioRegistro">
                    <label for="dni">DNI:</label><br>
                    <input type="text" name="dni" id="dni" required><br>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" name="nombre" id="nombre" required><br>
                    <label for="apellidos">Apellidos:</label><br>
                    <input type="text" name="apellidos" id="apellidos" required><br>
                    <label for="email">Correo electrónico:</label><br>
                    <input type="email" id="email" placeholder="Email@ejemplo.com" name="email" 
                    required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Utiliza un correo válido, con esta estructura: Email@ejemplo.com"><br>
                    <p>Utilizaremos tu correo electrónico para enviarte actualizaciones sobre tu contribución a la comunidad.</p><br>
                    <label for="password">Contraseña:</label><br>
                    <input type="password" name="password" id="password" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*"
                    title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, 
                    o un dígito. La contraseña debe empezar con una letra y contener al menor un dígito" required><br>
                    <label for="passwordConfirm">Confirmar contraseña:</label><br>
                    <input type="password" name="passwordConfirm"><br><br>
                    <input type="submit" formaction="#modal"  value="Crear cuenta"><br>
                    <p>Al unirte a FixPoint, aceptas nuestra <a href="http://">política de privacidad</a> y <a href="http://">términos</a>.</p>
                </form>
                <div class="alert alert-danger" id="alertwarning" role="alert">
                    
                </div>
                '.$errMessage.'
                
            </div>
        </div>
    </div>
    ';
}

function funcionalidadRegistro(){


    $mensajeError = '';

    /* Conseguimos datos */



    if (!empty($_POST['apellidos']) &&
        !empty($_POST['nombre']) &&
        !empty($_POST['dni']) &&
        !empty($_POST['email']) &&
        !empty($_POST['passwordConfirm']) &&
        !empty($_POST['password']
        )) {


        $apellidos = $_POST['apellidos'];
        $nombre = $_POST['nombre'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $password = $_POST['passwordConfirm'];
        $passwordConfirm = $_POST['password'];


        /*Comprobar si existe ese email o dni ya que son unique*/

        $queryEmail = "select email from usuario where email = '$email'";

        $sqlEmail = Connection::executeQuery($queryEmail);

        $numFilasSqlEmail = $sqlEmail->fetchAll();

        $queryDni = "SELECT dni FROM usuario where dni='$dni';";

        $sqlDni = Connection::executeQuery($queryDni);


        $numFilasSqlDni = $sqlDni->fetchAll();


        if ($numFilasSqlEmail) {
            $mensajeError .= '- El EMAIL que está intentando registrar ya existe.<br>';
        }
        if ($numFilasSqlDni) {
            $mensajeError .= '- El DNI que está intentando registrar ya existe.<br>';
        }



        if (!$numFilasSqlEmail && !$numFilasSqlDni) {

            /*HASHEAMOS la contraseña por seguridad*/
            $password = password_hash($password, PASSWORD_BCRYPT);
            $insertUsuario = "INSERT INTO usuario (nombre,apellidos, dni,email, password)
                        VALUES ('$nombre', '$apellidos','$dni','$email','$password')";

            /*Ejecutamos consulta*/

            if (Connection::executeQuery($insertUsuario)) {
                $mensajeError = 'Usuario creado correctamente';
            } else {
                $mensajeError = 'ERROR al crear el usuario, contacte con el administrador.';
            }
        }

    }
    return $mensajeError;
}

function iniciarSesion()
{
    $msg = "";
    if (isset($_POST['correo']) && isset($_POST['pass'])) {
        $msg = handleIniciarSesion($_POST['correo'], $_POST['pass']);
    }
    return '
    <div class="modalIniciarSesion" id="modalIniciar">
        <div class="modalContenido">
            <div class="modalHeader">
                <span class="cerrar">&times;</span>
                <h1 id="tituloIniciar">Iniciar Sesión</h1>
                <p>Nuevo? <a class="enlace" href="">Crear una cuenta</a></p>
            </div>
            <div class="modalBody">
                <form action="" method="post">
                    <label for="correo">Correo electrónico</label><br>
                    <!--pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"-->
                    <input class="redondeado" type="email" placeholder="Email@ejemplo.com" name="correo"
                    required title="Utiliza un correo válido, con esta estructura:Email@ejemplo.com"><br><br>
                    <label for="pass">Contraseña <a href="" class="enlace">Se te olvidó?</a></label>
                    <!--pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*"-->
                    <input class="redondeado" type="password" name="pass" 
                    title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito.
                    La contraseña debe empezar con una letra y contener al menor un dígito" required><br>
                    <p><input type="submit" formaction="#modalIniciar" class="btn-iniciarSesion" value="Iniciar sesión"></p>
                    <p>' . $msg . '</p>
                </form>
            </div>
        </div>
    </div>
    ';
}

function getFooter($footerArgs = null)
{
    $structure = footer();
    $structure .= '
    </body>
    </html>
    ';

    echo($structure);
}

function footer(): string
{
    return '
    <footer>
        <aside class="footerAsideizquierda">
            <p><a href="">Aviso legal</a></p>
            <p><a href="">Política de cookies</a></p>
            <p><a href="">Mapa web</a></p>
        </aside>
        <section class="footerSectionCentro">
            <img id="logoByN" src="./img/LogoFix(b&w).png" alt="FixPoint">
            <p>© 2021 FixPoint - Todos los derechos reservados</p>
        </section>
        <aside class="footerAsideDerecha">
            <p>C/Gervasio Manrique de Lara s/n</p>
            <p>42004 - Soria</p>
            <p>Tlfn: 975 239 443</p>
            <p>Email: <a href="mailto:info@fixpoint.com">info@fixpoint.com</a></p> 
        </aside>
    </footer>
    ';
}

function handleIniciarSesion($correo, $pass)
{
    try {
        $user = new User();
        $user->getUser($correo, $pass);
        if ($user->getDni() == null) {
            return "Email o Contrasenya incorrectos.";
        } else {
            $_SESSION["logged"] = true;
            $_SESSION["user"] = $user;
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri#");
            exit();
        }
    } catch (Exception $e) {
        return $e;
    }

}

function handleRegister($post) {

    $var = funcionalidadRegistro();
    return $var;

}
