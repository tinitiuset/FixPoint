<?php

namespace Grupo3\FixPoint;

require __DIR__ . '/../vendor/autoload.php';

use Dotenv;
use PDO;

class Connection
{
    private static PDO $connection;

    public static function __constructStatic()
    {
        try {

            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
            $dotenv->load();

            $db_host = $_SERVER['DB_HOST'];
            $db_name = $_SERVER['DB_NAME'];
            $u_name = $_SERVER['DB_USER'];
            $u_pass = $_SERVER['DB_PASS'];
            $port = $_SERVER['DB_PORT'];

            $conn = new PDO("mysql:host=$db_host;dbname=$db_name",
                $u_name, $u_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $conn;
        } catch (PDOException $e) {
            echo "Conexion fallida: " . $e->getMessage();
        }
    }

    static function executeQuery($query = null)
    {
       return self::$connection->query($query);
    }
}
Connection::__constructStatic();
?>