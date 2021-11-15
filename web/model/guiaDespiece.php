<?php

namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require_once __DIR__ . '/../Connection.php';

class guiaDespiece
{
    private $numFicha, $nombreMaquina, $revisada, $ocurrencia, $propuesta, $averias, $solucion;

    private array $pasos = [];

    /**
     * @return array
     */
    public function getPasos(): array
    {
        return $this->pasos;
    }

    /**
     * @param array $pasos
     */
    public function setPasos(array $pasos): void
    {
        $this->pasos = $pasos;
    }

    public function __construct($fecha, $nombreMaquina, $ocurrencia, $propuesta, $averias, $solucion)
    {
        $this->fecha = $fecha;
        $this->nombreMaquina = $nombreMaquina;

        $this->ocurrencia = $ocurrencia;
        $this->propuesta = $propuesta;
        $this->averias = $averias;
        $this->solucion = $solucion;
    }

    function getGuiaDespiece(int $numFicha)
    {
         $query = "SELECT * FROM `guiadespiece` WHERE `numFicha` LIKE '" . $numFicha . "' ";
         $guiaDespiece = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
         $this->setNumFicha($guiaDespiece['numFicha']);
         $this->setFecha($guiaDespiece['fecha']);
         $this->setNombreMaquina($guiaDespiece['nombreMaquina']);
         $this->setRevisada($guiaDespiece['revisada']);
         $this->setOcurrencia($guiaDespiece['ocurrencia']);
         $this->setPropuesta($guiaDespiece['propuesta']);
         $this->setAverias($guiaDespiece['averias']);
         $this->setSolucion($guiaDespiece['solucion']);

         Kint::dump($this);

    }

    /* La diferencia entre ambos create es que si la creas as admin
    la guia estara revisada directamente, si no estara sin revisar y por
    ende no será publicada hasta que lo esté*/

    public function createGuiaDespieceAsAdmin(){
        $query = "INSERT INTO `guiaDespiece` ( `fecha`,
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
        $query = "INSERT INTO `guiaDespiece` (`nombreMaquina`, `ocurrencia`, `propuesta`, `averias`, `solucion`) VALUES 
                                        (
                                         '" . $this->getNombreMaquina() . "',
                                         '" . $this->getOcurrencia() . "',
                                         '" . $this->getPropuesta() . "',
                                         '" . $this->getAverias() . "',
                                         '" . $this->getSolucion() . "'
                                         );";
        Connection::executeQuery($query);
    }

    public function recogerNumGuiaDeBD() {
        $query = "SELECT MAX(`numFicha`) AS 'num' FROM `guiaDespiece`";
        $num = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);

        $this->setNumFicha($num['num']);
    }

    public function guiaRevisada(){
        $query = "UPDATE `guiaDespiece` SET `revisada` = '" . ($this->getRevisada() ^ 1) . "' 
                  WHERE `guiaDespiece`.`numFicha` = '" . $this->getNumFicha() . "'; ";
        $this->revisada = 1;
        Connection::executeQuery($query)->execute();
    }

    // Actualiza la guía, excepto el parámetro "revisada"
    public function updateGuiaDespiece() {
        $query = "UPDATE guiaDespiece
        SET numFicha = '" . $this->getNumFicha() . "', 
        fecha = '" . $this->getFecha() . "', 
        nombreMaquina = '" . $this->getNombreMaquina() . "', 
        ocurrencia = '" . $this->getOcurrencia() . "', 
        propuesta = '" . $this->getPropuesta() . "', 
        averias = '" . $this->getAverias() . "', 
        solucion = '" . $this->getSolucion() . "', 
        WHERE numFicha LIKE '" . $this->getNumFicha() . "' ";

        Connection::executeQuery($query);
    }

    public function deleteGuiaDespiece() {
        $query = "DELETE FROM guiaDespiece WHERE numFicha LIKE '" . $this->getNumFicha() . "'";
        Connection::executeQuery($query);
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