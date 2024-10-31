<?php
include 'db.php';

$id = $_GET['id'];
$query = "DELETE FROM productos WHERE id = $id";

if ($conexion->query($query) === TRUE) {
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . $conexion->error;
}
?>
