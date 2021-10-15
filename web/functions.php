<?php


function getHeader($headerArgs = null) : void
{
    session_start();
    $structure = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
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

    return 'navbar';
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
    return 'footer';
}

