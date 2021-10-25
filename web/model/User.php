<?php


namespace Grupo3\FixPoint\model;
use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require __DIR__ .'/../Connection.php';

class User
{
    private $dni;

    private $nombre;

    private $apellidos;

    private $administrador;

    private $password;

    private $email;

    private $activo;

    /**
     * @param string $correo
     * @param string $pass
     */
    function getUser(string $correo, string $pass)
    {
         $query = "SELECT * FROM `usuario` WHERE `password` LIKE '".$pass."' AND `email` LIKE '".$correo."';";
         $User = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
         $this->setDni($User['dni']);
         $this->setNombre($User['nombre']);
         $this->setApellidos($User['apellidos']);
         $this->setAdministrador($User['administrador']);
         $this->setPassword(null);
         $this->setEmail($User['email']);
         $this->setActivo($User['activo']);
    }

    public function createUser()
    {
        $query = "INSERT INTO `usuario` (`dni`, `nombre`, `apellidos`, `administrador`, `password`, `email`) VALUES 
                                        ('" . $this->getDni() . "',
                                         '" . $this->getNombre() . "',
                                         '" . $this->getApellidos() . "',
                                         '" . $this->getAdministrador() . "',
                                         '" . $this->getPassword() . "',
                                         '" . $this->getEmail() . "'
                                         );";
        Connection::executeQuery($query);
    }

    public function activateUser()
    {
        $query = "UPDATE `usuario` SET `activo` = '" . $this->getActivo() . "' 
                  WHERE `usuario`.`dni` = '" . $this->getDni() . "'; ";
        $this->setActivo(!$this->getActivo());
        Connection::executeQuery($query)->execute();
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni): void
    {
        $this->dni = $dni;
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
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getAdministrador()
    {
        return $this->administrador;
    }

    /**
     * @param mixed $administrador
     */
    public function setAdministrador($administrador): void
    {
        $this->administrador = $administrador;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param mixed $activo
     */
    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }

}