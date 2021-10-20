<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

echo 'Sesion limpiada';
header('Refresh: 2; URL = login.php');
?>