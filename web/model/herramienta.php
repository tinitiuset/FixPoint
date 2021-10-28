<?php

namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require __DIR__ . '/../Connection.php';

class herramienta
{
    private $id_herramienta, $nombre, $modelo, $marca, $disponible, $foto, $observaciones, $idCategoria;

    /*Id herramienta es un auto increment de sql*/

    public function __construct($nombre, $modelo, $marca, $disponible, $foto, $observaciones, $idCategoria)
    {
        $this->nombre = $nombre;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->disponible = $disponible;
        $this->foto = $foto;
        $this->observaciones = $observaciones;
        $this->idCategoria = $idCategoria;
    }

    public function createTool()
    {
        $query = "INSERT INTO `herramienta` ( `nombre`,
                           `modelo`, `marca`, `disponible`, `foto`,`observaciones`, `idCategoria`) VALUES 
                                        (
                                         '" . $this->getNombre() . "',
                                         '" . $this->getModelo() . "',
                                         '" . $this->getMarca() . "',
                                         '" . $this->getDisponible() . "',
                                         '" . $this->getFoto() . "',
                                         '" . $this->getObservaciones() . "',
                                         '" . $this->getIdCategoria() . "'
                                         );";
        Connection::executeQuery($query);
    }


    public function getHerramienta(int $idHerr)
    {
        $query = "select * from `herramienta` where 
                        `id_herramienta` = '" . $idHerr . "' ";
        $tool = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        $this->setIdHerramienta($tool['id_herramienta']);
        $this->setNombre($tool['nombre']);
        $this->setModelo($tool['modelo']);
        $this->setMarca($tool['marca']);
        $this->setFoto($tool['foto']);
        $this->setDisponible($tool['disponible']);
        $this->setObservaciones($tool['observaciones']);
        $this->setIdCategoria($tool['idCategoria']);

        Kint::dump($this);
    }

    public function changeAvailability()
    {
        $query = "UPDATE `herramienta` SET `disponible` = '" . ($this->getDisponible() ^ 1) . "' 
                  WHERE `herramienta`.`id_herramienta` = '" . $this->getIdHerramienta() . "'; ";
        $this->getDisponible(!$this->getDisponible());
        Connection::executeQuery($query)->execute();
    }

    public function updateHerramienta(int $id_herramienta)
    {
        $query = "UPDATE herramienta 
        SET nombre = '" . $this->getNombre() . "', 
        modelo = '" . $this->getModelo() . "',
        marca = '" . $this->getMarca() . "',
        disponible = '" . $this->getDisponible() . "',
        observaciones = '" . $this->getObservaciones() . "',
        idCategoria = (SELECT idCategoria FROM categoria WHERE idCategoria LIKE '" . $this->getIdCategoria() . "')
        WHERE id_herramienta LIKE '" . $id_herramienta . "' ";

        Connection::executeQuery($query);
    }

    public function deleteHerramienta(int $id_herramienta)
    {
        $query = "DELETE FROM herramienta WHERE id_herramienta LIKE '" . $id_herramienta . "'";
        Connection::executeQuery($query);
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getIdHerramienta()
    {
        return $this->id_herramienta;
    }

    /**
     * @param mixed $id_herramienta
     */
    public function setIdHerramienta($id_herramienta): void
    {
        $this->id_herramienta = $id_herramienta;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo): void
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca): void
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param mixed $disponible
     */
    public function setDisponible($disponible): void
    {
        $this->disponible = $disponible;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param mixed $observaciones
     */
    public function setObservaciones($observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return mixed
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * @param mixed $idCategoria
     */
    public function setIdCategoria($idCategoria): void
    {
        $this->idCategoria = $idCategoria;
    }


}