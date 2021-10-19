<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

echo($_SERVER['DB_HOST']);
echo($_SERVER['DB_USER']);
echo($_SERVER['DB_PASS']);
echo($_SERVER['DB_PORT']);
?>