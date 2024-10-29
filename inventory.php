
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener estilos en styles.css -->
</head>
<body>

<header>
        <h1>Bienvenido admin</h1>
        <nav>
            <ul>
                
            <li><a href="register.php"><img src="imgs/icons8-usuario-30.png" alt=""></a></li>
            <li><a href="verordenes.php">Pedidos</a></li>
            <li><a href="reports.php">Reportes</a></li>
            <li><a href="platos.php">Platos</a></li>

            </ul>
        </nav>
    </header>

<section>
    <h2>Agregar Nuevo Item al Inventario</h2>
    <form method="POST" action="">
        <label for="item_name">Nombre del Item:</label>
        <input type="text" name="item_name" required>
        
        <label for="quantity">Cantidad:</label>
        <input type="number" name="quantity" required min="1">
        
        <button type="submit" name="submit_item">Agregar al Inventario</button>
    </form>
</section>

<section>
    <h2>Inventario Actual</h2>

    <?php
    // Conectar a la base de datos
    include('db_connect.php');

    // Agregar un nuevo item al inventario si el formulario se envía
    if (isset($_POST['submit_item'])) {
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];
        $last_updated = date('Y-m-d H:i:s'); // Fecha y hora actual

        // Consulta para insertar el nuevo item
        $sql_insert = "INSERT INTO inventory (item_name, quantity, last_updated) VALUES ('$item_name', '$quantity', '$last_updated')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<p>Item agregado con éxito al inventario.</p>";
        } else {
            echo "<p>Error al agregar el item: " . $conn->error . "</p>";
        }
    }

    // Consulta para obtener todos los items del inventario
    $sql = "SELECT id, item_name, quantity, last_updated FROM inventory ORDER BY last_updated DESC";
    $result = $conn->query($sql);

    // Mostrar los items en una tabla
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Item</th>
                    <th>Cantidad</th>
                    <th>Última Actualización</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["item_name"] . "</td>
                    <td>" . $row["quantity"] . "</td>
                    <td>" . $row["last_updated"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay items en el inventario.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</section>

</body>
</html>
