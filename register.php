<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encripta la contraseña
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO usuarios (nombre, apellido, email, password, telefono)
            VALUES ('$nombre', '$apellido', '$email', '$password', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles_coquette.css">
    <title>Registro de Usuario</title>
</head>
<body>
    <div class="container">
    <h2>Registrar Usuario</h2>
    <form method="post" action="">
        Nombre: <input type="text" name="nombre" required><br>
        Apellido: <input type="text" name="apellido" required><br>
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        Teléfono: <input type="text" name="telefono"><br>
        <input type="submit" value="Registrarse"  >
       
        <p>Ya tenes una cuenta?<a href="login.php">Toca Aqui</a></p>

    </form>
</div>
</body>
</html>
