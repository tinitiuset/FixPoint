<?php
/*Este archivo se utiliza para construir las regiones comunes de la pagina asi como el
header, footer, elementos de inicio, creacion de usuarios...*/

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <link rel="icon" type="image/x-icon" href="img/favicon.png">
        <title>' . $headerArgs['title'] . '</title>';
    foreach ($headerArgs['styles'] as $style) {
        $structure .= '<link rel="stylesheet" href="' . $style . '">';
    }
    foreach ($headerArgs['scripts'] as $script) {
        $structure .= '<script src="' . $script . '"></script> ';
    }
    $structure .= '
    </head>
    <body>';
    $structure .= navbar();
    $structure .= crearUsuario();
    $structure .= iniciarSesion();
    $structure .= confirmarGuia();
    echo($structure);
}

function navbar(): string
{
    $nav = '
    <header>
    <div class="container">
        <a class="logo" href="index.php"><img id="logoNavbar" src="./img/LogoFix-250px.png" alt="FixPoint LOGO"></a>
    </div>
    <nav id="site-nav" class="site-nav">
        <div class="linksNav"><a href="productos.php">Catálogo</a></div>
        <div class="linksNav"><a href="guiasVista.php">Guías despiece</a></div>
        <div class="linksNav"><a href="donarHerramientas.php">Donar Herramientas</a></div>
        <div class="linksNav"><a id="iniciarSesionTablet" href="contacto.php">Contacto <i class="fas fa-envelope"></i></a></div>
        <div class="Login" id="Login">
    ';

    if (!isset($_SESSION["logged"])) {

        $nav .= '
            <div class="Login-a"><a id="unirse" href="#">Unete</a></div>
            <div class="icon-bar"></div>
            <div class="Login-a"><a id="iniciarSesion" href="#">Iniciar Sesión</a></div>
        ';
    }

    $nav .= '
            </div>
        </nav>
        ';
    if (!isset($_SESSION["logged"])) {
        $nav .= '<div class="iconoLogin"><a href="#"><i id="iconIniciarSesion" class="far fa-user"></i></a></div>';
    }
    else{
        $userName = $_SESSION["user"]->getNombre();
        $isAdmin = $_SESSION["user"]->getAdministrador();
        $nav .= '
            <div class="imgUsuario dropdown" id="imgUsuarioLogueado" href="#">
                <p id="usernametext"><i class="fas fa-user"></i></p>
                <div class="dropdown-content">
            ';

        $isAdmin ? $nav .= '<a href="administracion.php">Administracion</a>' : '';

        $nav .= '
                    <a href="#" id="logOutBtn" onclick="logoutck();"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                </div>
                </div>
            <!--Rubrica js local storage-->
            <script>
                // LocalStorage
                localStorage.setItem("user", "' . $userName . '");
                document.getElementById("usernametext").innerHTML += "<br>"+localStorage.getItem("user");
            </script>
        ';
    }

    $nav .= '      
        <div id="menu-toggle" class="menu-toggle" onclick="cambiarClase()"> <!-- Usamos javascript nativo por lo que añadimos un evento
        en nuestro caso onClick que llama al menu-->
            <div class="hamburger"></div>
        </div>
    </header>
    ';

    return $nav;
}

function crearUsuario(): string
{
    /* Logica para mostrar el mensaje que devuelve la funcionalidad de registro*/
    $errMessage = '';
    if (isset($_POST['apellidos'])) {
        $errMessage = '
        <p>
            <div class="alert alert-danger" role="alert">
                ' . funcionalidadRegistro() . '
            </div>
        </p>';
    }
    /* Modal de Inicio de Sesion */
    return '
    <div class="modalCrearSesion" id="modal">
        <div class="modalContenidoCrear">
            <div class="modalHeaderCrear">
                <span id="cerrarCrear" class="cerrar">&times;</span>
                <h1 id="tituloCrear">Crear Cuenta</h1>
                <p>¿Has estado aquí antes? <a href="#" id="crearSesion_txtIniciar" class="enlace">Inicia sesión</a></p>
            </div>
            <div class="modalBodyCrear" id="modalBodyCrear">
                <form Class="paddingForm" action="" method="post" id="formularioRegistro">
                    <label class="textoFormCrear" for="dni">DNI:</label><br>
                    <input class="inputCrear" type="text" name="dni" id="dni" required><br>
                    <label class="textoFormCrear for="nombre">Nombre:</label><br>
                    <input class="inputCrear" type="text" name="nombre" id="nombre" required><br>
                    <label class="textoFormCrear" for="apellidos">Apellidos:</label><br>
                    <input class="inputCrear" type="text" name="apellidos" id="apellidos" required><br>
                    <label class="textoFormCrear" for="email">Correo electrónico:</label><br>
                    <input class="inputCrear" type="email" id="email" placeholder="Email@ejemplo.com" name="email" 
                    required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                    title="Utiliza un correo válido, con esta estructura: Email@ejemplo.com"><br>
                    <p class="aviso">Utilizaremos tu correo electrónico para enviarte actualizaciones sobre tu contribución a la comunidad.</p>
                    <label class="textoFormCrear" for="password">Contraseña:</label><br>
                    <input class="inputCrear" type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="La contraseña debe contener una mayuscula, una minuscula, un numero y como minimo 8 caracteres" required><br>
                    <label class="textoFormCrear" for="passwordConfirm">Confirmar contraseña:</label><br>
                    <input class="inputCrear" type="password" name="passwordConfirm"><br><br>
                    <p><input type="submit" formaction="#modal" class="btnCrearCuenta" value="Crear cuenta"></p>
                    <p class="aviso">Al unirte a FixPoint, aceptas nuestra <a href="http://" class="enlace">política de privacidad</a> y <a href="http://" class="enlace">términos</a>.</p>
                    ' . $errMessage . '
                </form>                
            </div>
        </div>
    </div>';
}

function funcionalidadRegistro(): string
{
    $mensajeError = '';

    /* Conseguimos datos */

    if (!empty($_POST['apellidos']) &&
        !empty($_POST['nombre']) &&
        !empty($_POST['dni']) &&
        !empty($_POST['email']) &&
        !empty($_POST['passwordConfirm']) &&
        !empty($_POST['password'])
    ) {
        $apellidos = $_POST['apellidos'];
        $nombre = $_POST['nombre'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $password = $_POST['password'];

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
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $insertUsuario = "INSERT INTO usuario (dni,nombre, apellidos, password, email)
                              VALUES ('$dni', '$nombre','$apellidos','$hashedPass','$email')";
            /*Ejecutamos consulta*/
            $mensajeError = Connection::executeQuery($insertUsuario) ?
                'Usuario creado correctamente' : 'ERROR al crear el usuario, contacte con el administrador.';
        }
    }
    return $mensajeError;
}

function iniciarSesion(): string
{
    $msg = "";
    if (isset($_POST['correo']) && isset($_POST['pass'])) {
        $msg = handleIniciarSesion($_POST['correo'], $_POST['pass']);
    }
    /* Modal iniciar sesion */
    return '
    <div class="modalIniciarSesion" id="modalIniciar">
        <div class="modalContenido">
            <div class="modalHeader">
                <span class="cerrar">&times;</span>
                <h1 id="tituloIniciar">Iniciar Sesión</h1>
                <p class="pCrearCuenta">Nuevo? <a class="enlace" id="iniciarSesion_txtCrear" href="#">Crear una cuenta</a></p>
            </div>
            <div class="modalBody">
                <form Class="paddingForm" action="" method="post">
                    <label class="textoForm" for="correo">Correo electrónico</label><br>
                    <!--pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"-->
                    <input class="redondeado" type="email" placeholder="Email@ejemplo.com" name="correo"
                    required title="Utiliza un correo válido, con esta estructura:Email@ejemplo.com" autofocus><br><br>
                    <label class="textoForm" for="pass">Contraseña <a href="" id="recuperar" class="enlace">Se te olvidó?</a></label>
                    <!--pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*"-->
                    <input class="redondeado" type="password" name="pass" 
                    title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito.
                    La contraseña debe empezar con una letra y contener al menor un dígito" required><br>
                    <p><input type="submit" formaction="#modalIniciar" class="btn-iniciarSesion" value="Iniciar sesión"></p>
                    <p id="loginErrorMessage">' . $msg . '</p>
                </form>
            </div>
        </div>
    </div>
    ';
}

function handleIniciarSesion($correo, $pass)
{
    try {
        $user = new User();

        $user->getUser($correo, $pass);

        if ($user->getDni() == null) {
            unset($_POST['correo']);
            unset($_POST['pass']);
            return "Email y/o Contraseña incorrectos.";
        } else {
            $_SESSION["logged"] = true;
            $_SESSION["user"] = $user;
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri#");
            //exit();=>Traperada Máxima, no se debe interrumpir la ejecución del código!!!
        }
    } catch (Exception $e) {
        return $e;
    }
}

function getFooter($footerArgs = null)
{
    $structure = '
    <footer>
        <aside class="footerAsideizquierda">
            <p><a href="avisoLegal.html" target="_blank">Aviso legal</a></p>
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
    $structure .= '
        </body>
    </html>
    ';

    echo($structure);
}

function confirmarGuia(): string
{
     /* Modal confirmar Guía */
    return '
    <div class="modalConfirmarGuia" id="modalConfirmarGuia">
        <div class="modalContenidoConfirmar">
            <div class="modalHeaderConfirmar">
                <h1 id="tituloConfirmarGuia">¿Confirmar y añadir la guía creada?</h1>
            </div>
            <div class="modalBodyConfirmar">
                <form action="" method="post">
                    <div class=botones>
                        <input type="submit" id="btnAceptarGuia"  formaction="./guiaDespiecePaso.php" name="btnConfirmarPasoAceptar" value="Aceptar">
                        <input type="submit" id="btnCancelarGuia" value="Cancelar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    ';
}