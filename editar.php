<?php
include 'db.php';

$id = (int)$_GET['id'];
$query = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$producto = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $cantidad = (int)$_POST['cantidad'];
    $precio = (float)$_POST['precio'];

    $query = $conexion->prepare("UPDATE productos SET nombre=?, cantidad=?, precio=? WHERE id=?");
    $query->bind_param("sdii", $nombre, $cantidad, $precio, $id);

    if ($query->execute()) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA WEB</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    color: #333;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    overflow-x: hidden;
}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('C:/xampp/htdocs/inventario/img/fondo.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    opacity: 0.8; /* Ajusta la opacidad aquí */
    z-index: -1;
}

.container {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9); /* Fondo con opacidad para el contenedor */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
}

    body {
    font-family: 'Open Sans', Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}
.container {
    width: 60%;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 25px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
h1 {
    text-align: center;
    color: #2c3e50;
}
form {
    display: flex;
    flex-direction: column;
}
label {
    font-weight: bold;
    color: #34495e;
    margin-top: 15px;
}
input[type="text"], input[type="number"] {
    padding: 12px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 16px;
}
input[type="submit"] {
    background-color: #2980b9;
    color: #ffffff;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
input[type="submit"]:hover {
    background-color: #3498db;
}
.back-link {
    display: block;
    text-align: center;
    color: #2980b9;
    text-decoration: none;
    margin-top: 20px;
}
.back-link:hover {
    color: #3498db;
}

    </style>
</head>
<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <h1>Editar Producto</h1>
        <form action="editar.php?id=<?php echo $producto['id']; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>
            
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
            
            <input type="submit" value="Guardar">
        </form>
        <a href="index.php" class="back-link">Volver al listado de productos</a>
    </div>
</body>
</html>
