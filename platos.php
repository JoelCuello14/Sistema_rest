<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<header>
        <h1>Bienvenido admin</h1>
        <nav>
            <ul>
            <li><a href="register.php"><img src="imgs/icons8-usuario-30.png" alt=""></a></li>
            <li><a href="verordenes.php">Pedidos</a></li>
                <li><a href="inventory.php">Inventario</a></li>
                <li><a href="reports.php">Reportes</a></li>
         
            </ul>
        </nav>
</body>
</html>
<?php

include 'db_connect.php';
// Crear un plato
if (isset($_POST['crear'])) {
    $dish_name = $_POST['dish_name'];
    $precio = $_POST['price'];
    $sql = "INSERT INTO menu (dish_name, price) VALUES ('$dish_name', '$precio')";
    if ($conn->query($sql) === TRUE) {
        echo "Plato creado exitosamente.";
    } else {
        echo "Error al crear el plato: " . $conn->error;
    }
}
// Eliminar un plato
if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM menu WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Plato eliminado exitosamente.";
    } else {
        echo "Error al eliminar el plato: " . $conn->error;
    }
}
?>

<h2>Administrar Platos</h2>

<!-- Formulario para crear/modificar/eliminar platos -->
<form method="post" action="">
    <label for="id">ID (solo para modificar o eliminar):</label>
    <input type="text" name="id"><br>

    <label for="dish_name">Nombre del Plato:</label>
    <input type="text" name="dish_name" required><br>

    <label for="price">Precio:</label>
    <input type="text" name="price" required><br>

    <input type="submit" name="crear" value="Crear">
    <input type="submit" name="modificar" value="Modificar">
    <input type="submit" name="eliminar" value="Eliminar">
</form>

<?php
// Mostrar los platos existentes
$sql = "SELECT id, dish_name, price FROM menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Platos en el menú</h3>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre del Plato</th>
                <th>Precio</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["dish_name"] . "</td>
                <td>" . $row["price"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay platos en el menú.";
}

// Cerrar conexión
$conn->close();
?>