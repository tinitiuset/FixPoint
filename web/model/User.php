<?php


namespace Grupo3\FixPoint\model;

use Grupo3\FixPoint\Connection;
use Kint\Kint;
use PDO;

require __DIR__ . '/../Connection.php';

class User
{
    private $dni;

    private $nombre;

    private $apellidos;

    private $administrador;

    private $password;

    private $email;

    private $activo;

    function __construct($dni = '', $nombre = '', $apellidos = '', $password = '', $email = '', $administrador = 0, $activo = 0)
    {

        $this->setDni($dni);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setAdministrador($administrador);
        $this->setActivo($activo);

    }

    /**
     * @param string $correo
     * @param string $pass
     */
    function getUser(string $correo, string $pass)
    {
        $query = "SELECT * FROM `usuario` WHERE `email` LIKE '" . $correo . "';";
        $User = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        if ($User) {
            $isPasswordCorrect = password_verify($pass, $User['password']);
            if ($isPasswordCorrect && $User['activo'] === '1') {
                $this->setDni($User['dni']);
                $this->setNombre($User['nombre']);
                $this->setApellidos($User['apellidos']);
                $this->setAdministrador($User['administrador']);
                $this->setPassword(null);
                $this->setEmail($User['email']);
                $this->setActivo($User['activo']);
            }
        }
    }

    /**
     * @param string $correo
     * @param string $pass
     */
    function getUserPublicData(string $dni)
    {
        $query = "SELECT * FROM `usuario` WHERE `dni` LIKE '" . $dni . "';";
        $User = Connection::executeQuery($query)->fetch(PDO::FETCH_ASSOC);
        if ($User) {
            $this->setDni($User['dni']);
            $this->setNombre($User['nombre']);
            $this->setApellidos($User['apellidos']);
            $this->setAdministrador(null);
            $this->setPassword(null);
            $this->setEmail($User['email']);
            $this->setActivo(null);
        }
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

    public function updateUser(int $dni)
    {
        $query = "UPDATE usuario
        SET dni = '" . $this->getDni() . "', 
        nombre = '" . $this->getNombre() . "',
        apellidos = '" . $this->getApellidos() . "',
        password = '" . $this->getPassword() . "',
        email = '" . $this->getEmail() . "'
        WHERE dni LIKE '" . $dni . "' ";

        Connection::executeQuery($query);
    }

    public function activateUser()
    {

        $query = "UPDATE `usuario` SET `activo` = '" . ($this->getActivo() ^ 1) . "' 
                  WHERE `usuario`.`dni` = '" . $this->getDni() . "'; ";
        $this->setActivo(!$this->getActivo());
        Connection::executeQuery($query)->execute();
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

    public function deleteUser(int $dni)
    {
        $query = "DELETE FROM user WHERE dni LIKE '" . $dni . "'";
        Connection::executeQuery($query);
    }

}