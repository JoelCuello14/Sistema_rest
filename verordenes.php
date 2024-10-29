<?php
// Conexión a la base de datos
include 'db_connect.php';

// Consulta para obtener las órdenes junto con el nombre del plato y el total
$sql = "SELECT orders.id, orders.customer_name, menu.dish_name, orders.quantity, orders.order_date, orders.total
        FROM orders
        JOIN menu ON orders.dish_id = menu.id
        ORDER BY orders.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Listado de Órdenes</title>
</head>
<body>
<header>
    <h1>Bienvenido a nuestro Restaurante</h1>
    <nav>
        <ul>
            <li><a href="register.php"><img src="imgs/icons8-usuario-30.png" alt=""></a></li>
            <li><a href="index2.html">Inicio</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="orders.php">Realizar Pedido</a></li>
            <li><a href="reports.php">Reportes</a></li>
        </ul>
    </nav>
</header>
<h2>Listado de Órdenes</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Orden</th>
            <th>Nombre del Cliente</th>
            <th>Plato</th>
            <th>Cantidad</th>
            <th>Fecha de Orden</th>
            <th>Total a Pagar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Mostrar los datos de cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['customer_name'] . "</td>";
                echo "<td>" . $row['dish_name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
                echo "<td>$" . number_format($row['total'], 2) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay órdenes registradas</td></tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>

<?php
$conn->close();
?>
