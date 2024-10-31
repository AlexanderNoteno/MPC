<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizar y validar las entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $cantidad = htmlspecialchars(trim($_POST['cantidad']));
    $precio = htmlspecialchars(trim($_POST['precio']));

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO productos (nombre, cantidad, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $nombre, $cantidad, $precio);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA WEB</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Agregar Producto</h3>
                    </div>
                    <div class="card-body">
                        <form action="agregar.php" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre del Producto:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" class="form-control" name="cantidad" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio (SOLES):</label>
                                <input type="number" step="0.01" class="form-control" name="precio" min="0" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Agregar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

