<?php

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Formato-->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!--Le decimos al navegador que el tamaño va a ser igual al dispositivo-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Damos palabras claves para los buscadores-->
    <meta name="description" content="Biblioteca de herramientas." />
    <meta name="keywords" content="herramientas; alquiler; guías; despiece" />
    <!--Creamos el favicon-->
    <link rel="icon" href="../web/FILES/favicon.png" type="image/ico">
    <!-- Cargamos las hojas de estilo que va a utilizar la página-->
    <link rel="stylesheet" href="../web/CSS/CSS_Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!--Cargamos los Script-->
    <script src="../web/JS/Menu.js"></script>
    <!--Titulo que queremos que tenga la pagina en concreto-->
    <title>Inicio</title>
</head>

<body>
    <header>
        <div class="container">
            <a class="logo" href="Index.html"><img src="../web/FILES/Logo-250px.png" alt="FixPoint LOGO"></a>
        </div>
        <nav id="site-nav" class="site-nav">
            <div class="site-nav-a"><a href="">Catálogo</a></div>
            <div class="site-nav-a"><a href="">Guías despiece</a></div>
            <div class="site-nav-a"><a href="">Donar herramientas</a></div>
            <div class="site-nav-a"><a href="">Contacto <i class="fas fa-envelope"></i></a></div>
        </nav>
        <div class="Login">
            <div class="Login-a"><a href="">Unete</a></div>
            <div class="icon-bar"></div>
            <div class="Login-a"><a href="">Iniciar Sesión</a></div>
        </div>
        <div id="menu-toggle" class="menu-toggle" onClick="cambiarClase()"> <!-- Usamos javascript nativo por lo que añadimos un evento
        en nuestro caso onClick que llama al Menu.js-->
            <div class="hamburger"></div>
        </div>
    </header>
    
</body>
</html>