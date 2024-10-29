<?php
// Conectar a la base de datos
include('db_connect.php');

// Procesar el pedido cuando el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $dishes = $_POST['dishes'];
    $quantities = $_POST['quantities'];
    $order_date = date("Y-m-d");

    foreach ($dishes as $index => $dish_id) {
        $quantity = $quantities[$index];

        if (!empty($dish_id) && !empty($quantity)) {
            // Obtener el precio del plato
            $price_sql = "SELECT price FROM menu WHERE id = $dish_id";
            $price_result = $conn->query($price_sql);
            $price_row = $price_result->fetch_assoc();
            $price = $price_row['price'];

            // Calcular el total para este plato
            $total = $quantity * $price;

            // Insertar el pedido en la tabla orders con el total
            $sql = "INSERT INTO orders (customer_name, dish_id, quantity, order_date, total)
                    VALUES ('$customer_name', '$dish_id', '$quantity', '$order_date', '$total')";
            $conn->query($sql);
        }
    }
    
    echo "Pedido realizado con éxito.";
}

// Obtener platos del menú
$sql = "SELECT id, dish_name, price FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Realizar Pedido</title>
</head>
<body>
<header>
    <h1>Bienvenido a nuestro Restaurante</h1>
    <nav>
        <ul>
        <li><a href="register.php"><img src="imgs/icons8-usuario-30.png" alt=""></a></li>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="verordenes.php">Mis pedidos</a></li>
            <li><a href="reports.php">Reportes</a></li>
        </ul>
    </nav>
</header>
<h2>Realizar Pedido</h2>
<form method="post">
    <label for="customer_name">Nombre del Cliente:</label>
    <input type="text" id="customer_name" name="customer_name" required><br><br>

    <h3>Seleccionar Platos:</h3>
    <div id="dish-container">
        <div class="dish-row">
            <select name="dishes[]">
                <option value="">Seleccionar plato</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['dish_name'] . " - $" . $row['price'] . "</option>";
                    }
                }
                ?>
            </select>
            <input type="number" name="quantities[]" placeholder="Cantidad" min="1">
        </div>
    </div>
    
    <br>
    <button type="button" onclick="addDishRow()">Agregar otro plato</button>
    <br><br>
    <input type="submit" value="Realizar Pedido">
</form>

<script>
    function addDishRow() {
        var container = document.getElementById('dish-container');
        var row = document.createElement('div');
        row.classList.add('dish-row');
        
        row.innerHTML = `
            <select name="dishes[]">
                <option value="">Seleccionar plato</option>
                <?php
                $result->data_seek(0); // Volver al inicio de los resultados
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['dish_name'] . " - $" . $row['price'] . "</option>";
                }
                ?>
            </select>
            <input type="number" name="quantities[]" placeholder="Cantidad" min="1">
        `;
        
        container.appendChild(row);
    }
</script>
</body>
</html>

<?php
$conn->close();
?>
