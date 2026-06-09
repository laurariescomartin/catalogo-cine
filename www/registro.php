<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = 'normal';  // Añadimos rol por defecto

    $stmt = $conn->prepare("INSERT INTO Usuario (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $password, $rol);

    if ($stmt->execute()) {
        echo $twig->render('registro.html.twig', ['exito' => true]);
    } else {
        echo $twig->render('registro.html.twig', ['error' => "El email ya está registrado o hubo un error."]);
    }
} else {
    echo $twig->render('registro.html.twig');
}
