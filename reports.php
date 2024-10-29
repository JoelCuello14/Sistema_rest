<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener estilos en styles.css -->
</head>
<body>
<header>
        <h1>Bienvenido a nuestro Restaurante</h1>
        <nav>
            <ul>
            <li><a href="register.php"><img src="imgs/icons8-usuario-30.png" alt=""></a></li>
                <li><a href="index2.html">inicio</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="verordenes.php">Pedidos</a></li>

                <li><a href="verordenes.php">Mis pedidos</a></li>
         
   
           
            </ul>
        </nav>
    </header>

<section>
    <h2>Crear Nuevo Reporte</h2>
    <form method="POST" action="">
        <label for="report_type">Tipo de Reporte:</label>
        <input type="text" name="report_type" required>
        <button type="submit" name="submit_report">Agregar Reporte</button>
    </form>
</section>

<section>
    <h2>Listado de Reportes</h2>

    <?php
    // Conectar a la base de datos
    include('db_connect.php');

    // Agregar un nuevo reporte si el formulario se envía
    if (isset($_POST['submit_report'])) {
        $report_type = $_POST['report_type'];
        $report_date = date('Y-m-d'); // Fecha actual

        // Consulta para insertar el nuevo reporte
        $sql_insert = "INSERT INTO reports (report_type, report_date) VALUES ('$report_type', '$report_date')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<p>Reporte agregado con éxito.</p>";
        } else {
            echo "<p>Error al agregar el reporte: " . $conn->error . "</p>";
        }
    }

    // Consulta para obtener todos los reportes
    $sql = "SELECT id, report_type, report_date FROM reports ORDER BY report_date DESC";
    $result = $conn->query($sql);

    // Mostrar los reportes en una tabla
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Reporte</th>
                    <th>Fecha de Reporte</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["report_type"] . "</td>
                    <td>" . $row["report_date"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay reportes disponibles.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</section>

</body>
</html>
