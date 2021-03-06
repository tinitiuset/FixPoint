<?php

namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;

require_once __DIR__ . '/../Connection.php';

class Paso
{
    private $foto;
    private $detalle;
    private $numGuia;

    public function __construct($foto, $detalle, $numGuia)
    {
        $this->setFoto($foto);
        $this->setDetalle($detalle);
        $this->setNumGuia($numGuia);
    }

    public function createPaso($numPaso)
    {
        $query = "INSERT INTO `paso`(`numpaso`,`numficha`, `detalle`, `foto`) VALUES 
        (     $numPaso,
         '" . $this->getNumGuia() . "',
        '" . $this->getDetalle() . "',
        '" . $this->getFoto() . "'
        )";

        Connection::executeQuery($query);
    }

    /**
     * Get the value of numGuia
     */
    public function getNumGuia()
    {
        return $this->numGuia;
    }

    /**
     * Set the value of numGuia
     *
     * @return  self
     */
    public function setNumGuia($numGuia)
    {
        $this->numGuia = $numGuia;

        return $this;
    }

    /**
     * Get the value of detalle
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set the value of detalle
     *
     * @return  self
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }
}

?>