<?php
$host = 'localhost';
$usuario = 'root'; // Cambia esto si tienes un usuario diferente
$password = ''; // Cambia esto si tu usuario tiene contraseña
$dbname = 'inventario'; // Nombre de la base de datos

$conexion = new mysqli($host, $usuario, $password, $dbname);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>