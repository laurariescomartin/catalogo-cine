<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

// Configurar Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, password, rol FROM Usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $nombre, $hash, $rol);

    if ($stmt->fetch() && password_verify($pass, $hash)) {
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol;
        $_SESSION['anonimo'] = false;

        header("Location: panel.php");
        exit;
    } else {
        echo $twig->render('login.html.twig', [
            'error' => 'Correo o contraseña incorrectos.'
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    // Mostrar el formulario (GET)
    echo $twig->render('login.html.twig');
}
