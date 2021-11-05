<?php
    session_start();
    unset($_SESSION["logged"]);

    header('Refresh: 0; URL = index.php');
