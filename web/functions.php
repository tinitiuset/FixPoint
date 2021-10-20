<?php


function getHeader($headerArgs = null) : void
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
        <title>'.$headerArgs['title'].'</title>
    ';
    foreach ($headerArgs['styles'] as $style){
        $structure .= '<link rel="stylesheet" href="'. $style.'">';
    }
    foreach ($headerArgs['scripts'] as $script){
        $structure .= '<script src="'. $script.'"></script> ';
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

    return '
    <header>
        <div class="container">
            <a class="logo" href="index.php"><img src="../web/img/Logo-250px.png" alt="FixPoint LOGO"></a>
        </div>
        <nav id="site-nav" class="site-nav">
            <div class="catalogo"><a href="">Catálogo</a></div>
            <div class="Guías"><a href="">Guías despiece</a></div>
            <div class="Donar"><a href="">Donar herramientas</a></div>
            <div class="Contacto"><a href="">Contacto <i class="fas fa-envelope"></i></a></div>
            <div class="Login" id="Login">
                <div class="Login-a"><a id="unirse" href="#">Unete</a></div>
                <div class="icon-bar"></div>
                <div class="Login-a"><a id="iniciarSesion" href="#">Iniciar Sesión</a></div>
            </div>
        </nav>
        <div  class="iconoLogin"><a href=""><i class="far fa-user"></i></a></div>
        <div id="menu-toggle" class="menu-toggle"> <!-- Usamos javascript nativo por lo que añadimos un evento
        en nuestro caso onClick que llama al menu.js-->
            <div class="hamburger"></div>
        </div>
    </header>
    ';
}

function crearUsuario(): string
{
    return '
    <!-- Modal creación de usuario -->
    <div class="modalCrearSesion" id="modal">
        <div class="modalContenido">
            <div class="modalHeader">
                <span class="cerrar">&times;</span>
                <h2>Crear Cuenta</h2>
                <p>¿Has estado aquí antes? <a href="http://">Inicia sesión</a></p>
            </div>
            <div class="modalBody">
                <form action="" method="post">
                    <label for="dni">DNI:</label><br>
                    <input type="text" name="dni" required><br>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" name="nombre" required><br>
                    <label for="apellidos">Apellidos:</label><br>
                    <input type="text" name="apellidos" required><br>
                    <label for="correo">Correo electrónico:</label><br>
                    <input type="email" placeholder="Email@ejemplo.com" name="correo" 
                    required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Utiliza un correo válido, con esta estructura: Email@ejemplo.com"><br>
                    <p>Utilizaremos tu correo electrónico para enviarte actualizaciones sobre tu contribución a la comunidad.</p><br>
                    <label for="contrasena">Contraseña:</label><br>
                    <input type="password" name="contrasena" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*"
                    title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, 
                    o un dígito. La contraseña debe empezar con una letra y contener al menor un dígito" required><br>
                    <label for="confirmarContrasena">Confirmar contraseña:</label><br>
                    <input type="password" name="confirmarContrasena"><br><br>
                    <input type="submit" value="Crear cuenta"><br>
                    <p>Al unirte a FixPoint, aceptas nuestra <a href="http://">política de privacidad</a> y <a href="http://">términos</a>.</p>
                </form>
            </div>
        </div>
    </div>
    ';
}

function iniciarSesion(){
    return '
    <div class="modalIniciarSesion" id="modalIniciar">
        <div class="modalContenido">
            <div class="modalHeader">
                <span class="cerrar">&times;</span>
                <h1>Iniciar Sesión</h1>
                <p>Nuevo? <a class="enlace" href="">Crear una cuenta</a></p>
            </div>
            <div class="modalBody">
                <form action="" method="post">
                    <label for="correo">Correo electrónico</label><br>
                    <input type="email" placeholder="Email@ejemplo.com" name="correo"
                    required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Utiliza un correo válido, con esta estructura:Email@ejemplo.com"><br><br>
                    <label for="pass">Contraseña <a href="" class="enlace">Se te olvidó?</a></label>>
                    <input type="password" name="pass" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*"
                    title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito.
                    La contraseña debe empezar con una letra y contener al menor un dígito" required><br>
                    <p><input type="submit" class="btn-iniciarSesion" value="Iniciar sesión"></p><br>
                </form>
            </div>
        </div>
    </div>
    ';
}

function getFooter($footerArgs = null)
{
    $structure = footer();
    $structure .='
    </body>
    </html>
    ';

    echo($structure);
}

function footer() : string
{
    return '
    <footer>
        <aside class="footerAsideizquierda">
            <p>Aviso legal</p>
            <p>Política de cookies</p>
            <p>Mapa web</p>
        </aside>
        <section class="footerSectionCentro">
            <img src="./img/LogoFix(b&w).png" alt="FixPoint">
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

