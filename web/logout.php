<?php
/*EL BOTON DE LOGOUT LLAMA A ESTE PHP, AQUI DESTRUYE LA SESSION Y REENVIA A INDEX.PHP*/
    session_start();
    session_destroy();
    header('Refresh: 0; URL = index.php');
