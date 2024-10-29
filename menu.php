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
        <h1>Bienvenido a nuestro Restaurante</h1>
        <nav>
            <ul>
            <li><a href="register.php"><img src="imgs/icons8-usuario-30.png" alt=""></a></li>
                <li><a href="index2.html">inicio</a></li>
                <li><a href="orders.php">Realizar Pedido</a></li>
                <li><a href="verordenes.php">Mis pedidos</a></li>
                <li><a href="reports.php">Reportes</a></li>
   
           
            </ul>
        </nav>
    </header>
</body>
</html>
<?php
// Connect to the database
include('db_connect.php');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los platos del menú
$sql = "SELECT dish_name, price FROM menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar datos en una tabla
    echo "<table border='1'>
            <tr>
                <th>Nombre del Plato</th>
                <th>Precio</th>
            </tr>";
    // Recorrer los resultados y mostrarlos
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
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