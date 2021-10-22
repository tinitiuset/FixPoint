<?php

namespace Grupo3\FixPoint\model;
use Grupo3\FixPoint\Connection;
use PDO;

require __DIR__ .'/../Connection.php';

class Categoria {
    private $idCategoria;
    private $nombre;

    public function __construct($idCategoria = '', $nombre = '')
    {
        $this->setIdCategoria($idCategoria);
        $this->setNombre($nombre);
    }

    function getCategoria(int $idCategoria) {
        $query = "SELECT * FROM `categoria` WHERE `idCategoria` LIKE '".$idCategoria."' ";
        $Categoria = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        $this->setIdCategoria($Categoria['idCategoria']);
        $this->setNombre($Categoria['nombre']);
    }

    public function createCategoria()
    {
        $query = "INSERT INTO `categoria` (`idCategoria`, `nombre`) VALUES 
                                        ('" . $this->getIdCategoria() . "',
                                         '" . $this->getNombre() . "',
                                         );";
        Connection::executeQuery($query);
    }

    public function updateCategoria(int $idCategoria) {
        $query = "UPDATE 'categoria' 
        SET idCategoria = ' . $this->getIdCategoria() . ', 
        nombre = ' . $this->getNombre() . ' 
        WHERE dni LIKE '" . $idCategoria . "' ";

        Connection::executeQuery($query);
    }

    public function deleteCategoria(int $idCategoria) {
        $query = "DELETE FROM 'categoria' WHERE 'idCategoria' LIKE '" . $idCategoria . "'";
        
        Connection::executeQuery($query);
    }

    /**
     * Get the value of idCategoria
     */ 
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of idCategoria
     *
     * @return  self
     */ 
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}

?>