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
        $Alquiler = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        $this->setDni($Alquiler['dni']);
        $this->setIdHerramienta($Alquiler['id_herramienta']);
        $this->setFechaInicio($Alquiler['fechaInicio']);
        $this->setDias($Alquiler['dias']);

        Kint::dump($this);
    }

    public function createAlquiler()
    {
        $query = "INSERT INTO `alquiler` (`dni`, `id_herramienta`, `fechaInicio`, `dias`) VALUES
                                        (
                                            '".$this->getDni() . "',
                                            '".$this->getIdHerramienta() . "',
                                            '".$this->getFechaInicio() . "',
                                            '".$this->getDias() . "',
                                        );";
        connection::executeQuery($query);
    }

   public function updateAlquiler(char $dni, int $id_herramienta) {
        $query = "UPDATE alquiler
        SET fechaInicio = '" . $this->getFechaInicio() . "',
        dias = '" .$this->getDias() . "',
        dni = (SELECT dni FROM usuario WHERE dni LIKE '" . $this->getDni() . "'),
        id_herramienta = (SELECT id_herramienta FROM herramienta WHERE id_herramienta LIKE '" . $this->getIdHerramienta() . "')
        WHERE dni LIKE '".$dni."' AND id_herrramienta LIKE '".$id_herramienta."' ";

        Connection::executeQuery($query);
   }

   public function deleteAlquiler(char $dni, int $id_herramienta) {
       $query = "DELETE FROM alquiler WHERE 'dni' LIKE '" . $dni ."' AND id_herrramienta LIKE '".$id_herramienta."' ";
       Connection::executeQuery($query);
   }

    



    /**
     * Get the value of fechaInicio
     */ 
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */ 
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of dias
     */ 
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set the value of dias
     *
     * @return  self
     */ 
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of id_herramienta
     */ 
    public function getId_herramienta()
    {
        return $this->id_herramienta;
    }

    /**
     * Set the value of id_herramienta
     *
     * @return  self
     */ 
    public function setId_herramienta($id_herramienta)
    {
        $this->id_herramienta = $id_herramienta;

        return $this;
    }
}



?>