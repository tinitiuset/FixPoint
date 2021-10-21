<?php


namespace Grupo3\FixPoint\model;
use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require __DIR__ .'/../Connection.php';

class Alquiler
{
    private $fechaInicio, $dias, $dni, $id_herramienta;

    function __construct($fechaInicio, $dias, $dni, $id_herramienta)
    {
        $this->setFechaInicio($fechaInicio);
        $this->setDias($dias);
        $this->setDni($dni);
        $this->setIdHerramienta($id_herramienta);

    }

    function getAlquiler(char $dni, int $id_herramienta)
    {
        $query = "SELECT * FROM `alquiler` WHERE `dni` LIKE '".$dni."' ";
    }

    


}



?>