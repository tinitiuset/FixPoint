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
    echo($structure);
}

function navbar(): string
{

    return '';
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
            <img src="img/LogoFooter.png" alt="FixPoint">
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

