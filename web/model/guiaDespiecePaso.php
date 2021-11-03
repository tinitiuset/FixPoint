<?php

namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require __DIR__ . '/../Connection.php';

class paso
{
    private $foto;
    private $detalle;
    private $numPaso;
    private $numGuia;

    function __construct($foto, $detalle, $numPaso, $numGuia)
    {
        $this->setFoto($foto);
        $this->setDetalle($detalle);
        $this->setNumPaso($numPaso);
        $this->setNumGuia($numGuia);
    }

    function getPaso(int $numGuia) {
        $query = "SELECT * FROM paso WHERE numficha LIKE '" . $numGuia . "'";
        $paso = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        $this->setNumGuia($paso['numficha']);
        $this->setNumPaso($paso['numpaso']);
        $this->setFoto($paso['foto']);
        $this->setDetalle($paso['detalle']);
    }

    public function createPaso(){
        $query = "INSERT INTO `paso` (numpaso, numficha, detalle, foto) VALUES 
                                        (
                                         '" . $this->getNumPaso() . "',
                                         '" . $this->getNumGuia() . "',
                                         '" . $this->getDetalle() . "',
                                         '" . $this->getFoto() . "'
                                         );";
        Connection::executeQuery($query);
    }

    public function updatePaso(int $numPaso, int $numGuia) {
        $query = "UPDATE paso SET 
        detalle = '" . $this->getDetalle() . "',
        foto = '" . $this->getFoto() . "'
        WHERE numficha LIKE '" . $numGuia . "' AND numpaso LIKE '" . $numPaso . "'";

        Connection::executeQuery($query);
    }

    public function deletePaso() {
        $query = "DELETE FROM paso WHERE numficha LIKE '" . $this->getNumGuia() . "' AND numpaso LIKE '" . $this->getNumPaso() . "'";
        Connection::executeQuery($query);
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
     * Get the value of numPaso
     */ 
    public function getNumPaso()
    {
        return $this->numPaso;
    }

    /**
     * Set the value of numPaso
     *
     * @return  self
     */ 
    public function setNumPaso($numPaso)
    {
        $this->numPaso = $numPaso;

        return $this;
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
}

?>