<?php
    session_start();
    /*unset($_SESSION["logged"]);*/
    session_destroy();

    header('Refresh: 0; URL = index.php');
