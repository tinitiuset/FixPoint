<?php 
//Datos de la BD
$serverName = "localhost";
$uName = "root";
$pass = "";
$db_name = "fixpoint";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$db_name",
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Conexion fallida: ". $e->getMessage();
}