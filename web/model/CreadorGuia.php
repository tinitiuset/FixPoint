<?php

namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;
use PDO;

require_once __DIR__ .'/../Connection.php';

class CreadorGuia
{
    private $dni;
    private $numFicha;

    public function __construct($dni = '', $numFicha = '')
    {
        $this->setDni($dni);
        $this->setNumFicha($numFicha);
    }

    function getCreadorGuia(int $dni)
    {
        $query = "SELECT * FROM `creadorGuia` WHERE `dni` LIKE '".$dni."' ";
        $creadorguia = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        $this->setdni($creadorguia['dni']);
        $this->setNumFicha($creadorguia['numFicha']);
    }
    function getCreadorGuiaByNumFicha(int $numFicha)
    {
        $query = "SELECT * FROM `creadorGuia` WHERE `numFicha` LIKE '".$numFicha."' ";
        $creadorguia = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        $this->setdni($creadorguia['dni']);
        $this->setNumFicha($creadorguia['numFicha']);
    }

    public function createCreadorGuia()
    {
        $query = "INSERT INTO `creadorGuia` (`dni`, `numFicha`) VALUES 
                                        ((SELECT dni FROM usuario WHERE dni LIKE '" . $this->getDni() . "'),
                                         (SELECT numFicha FROM guiadespiece WHERE numFicha LIKE '" . $this->getNumFicha() . "')
                                         );";
        Connection::executeQuery($query);
    }

    public function updateCreadorGuia(int $dni) {
        $query = "UPDATE creadorGuia 
        SET dni = (SELECT dni FROM usuario WHERE dni LIKE '" . $this->getDni() . "'), 
        numFicha = (SELECT numFicha FROM guiaDespiece WHERE numFicha LIKE '" . $this->getNumFicha() . "') 
        WHERE dni LIKE '" . $dni . "' ";

        Connection::executeQuery($query);
    }

    public function deleteCreadorGuia(int $dni) {
        $query = "DELETE FROM creadorGuia WHERE 'dni' LIKE '" . $dni . "'";
        Connection::executeQuery($query);
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
     * Get the value of numFicha
     */ 
    public function getNumFicha()
    {
        return $this->numFicha;
    }

    /**
     * Set the value of numFicha
     *
     * @return  self
     */ 
    public function setNumFicha($numFicha)
    {
        $this->numFicha = $numFicha;

        return $this;
    }
}

?>