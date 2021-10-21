<?php

namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require __DIR__ . '/../Connection.php';

class guiaDespiece
{
    private $numFicha, $fecha, $nombreMaquina, $revisada, $ocurrencia, $propuesta, $averias, $solucion;

    public function __construct($fecha, $nombreMaquina, $ocurrencia, $propuesta, $averias, $solucion)
    {
        $this->fecha = $fecha;
        $this->nombreMaquina = $nombreMaquina;

        $this->ocurrencia = $ocurrencia;
        $this->propuesta = $propuesta;
        $this->averias = $averias;
        $this->solucion = $solucion;
    }
    /* La diferencia entre ambos create es que si la creas as admin
    la guia estara revisada directamente, si no estara sin revisar y por
    ende no será publicada hasta que lo esté*/

    public function createGuiaDespieceAsAdmin(){
        $query = "INSERT INTO `guiadespiece` ( `fecha`,
                           `nombreMaquina`, `revisada`, `ocurrencia`, `propuesta`, `averias`, `solucion`) VALUES 
                                        (
                                         '" . $this->getFecha() . "',
                                         '" . $this->getNombreMaquina() . "',
                                         '" . 1 . "',
                                         '" . $this->getOcurrencia() . "',
                                         '" . $this->getPropuesta() . "',
                                         '" . $this->getAverias() . "',
                                         '" . $this->getSolucion() . "'
                                         );";
        Connection::executeQuery($query);
    }

    public function createGuiaDespiece(){
        $query = "INSERT INTO `guiadespiece` ( `fecha`,
                           `nombreMaquina`, `ocurrencia`, `propuesta`, `averias`, `solucion`) VALUES 
                                        (
                                         '" . $this->getFecha() . "',
                                         '" . $this->getNombreMaquina() . "',
                                         '" . $this->getOcurrencia() . "',
                                         '" . $this->getPropuesta() . "',
                                         '" . $this->getAverias() . "',
                                         '" . $this->getSolucion() . "'
                                         );";
        Connection::executeQuery($query);
    }

    public function guiaRevisada(){
        $this->revisada = 1;
    }

    /**
     * @return mixed
     */
    public function getNumFicha()
    {
        return $this->numFicha;
    }

    /**
     * @param mixed $numFicha
     */
    public function setNumFicha($numFicha): void
    {
        $this->numFicha = $numFicha;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getNombreMaquina()
    {
        return $this->nombreMaquina;
    }

    /**
     * @param mixed $nombreMaquina
     */
    public function setNombreMaquina($nombreMaquina): void
    {
        $this->nombreMaquina = $nombreMaquina;
    }

    /**
     * @return mixed
     */
    public function getRevisada()
    {
        return $this->revisada;
    }

    /**
     * @param mixed $revisada
     */
    public function setRevisada($revisada): void
    {
        $this->revisada = $revisada;
    }

    /**
     * @return mixed
     */
    public function getOcurrencia()
    {
        return $this->ocurrencia;
    }

    /**
     * @param mixed $ocurrencia
     */
    public function setOcurrencia($ocurrencia): void
    {
        $this->ocurrencia = $ocurrencia;
    }

    /**
     * @return mixed
     */
    public function getPropuesta()
    {
        return $this->propuesta;
    }

    /**
     * @param mixed $propuesta
     */
    public function setPropuesta($propuesta): void
    {
        $this->propuesta = $propuesta;
    }

    /**
     * @return mixed
     */
    public function getAverias()
    {
        return $this->averias;
    }

    /**
     * @param mixed $averias
     */
    public function setAverias($averias): void
    {
        $this->averias = $averias;
    }

    /**
     * @return mixed
     */
    public function getSolucion()
    {
        return $this->solucion;
    }

    /**
     * @param mixed $solucion
     */
    public function setSolucion($solucion): void
    {
        $this->solucion = $solucion;
    }


}