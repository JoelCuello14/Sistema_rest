<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar el email en la base de datos
    $sql = "SELECT id, nombre, password FROM usuarios WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];

            // Verificar si el email coincide con el del administrador//contra : 1111
            if ($email === "administradorprueba@gmail.com") {
                header("Location: index.html");
            } else {
                header("Location: index2.html ");
            }
            exit(); // Asegúrate de que el script termine aquí para evitar continuar con la ejecución.
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró una cuenta con ese email.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="styles_coquette.css">

    <title>Login de Usuario</title>
</head>
<body>
    <div class="container">
    <h2>Iniciar Sesion</h2>
    <form method="post" action="">
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <p>No tienes una cuenta?<a href="register.php">Toca Aqui</a></p>
</div>
</body>
</html>
