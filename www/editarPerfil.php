<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE Usuario SET nombre = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nombre, $email, $hash, $id);
    } else {
        $stmt = $conn->prepare("UPDATE Usuario SET nombre = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nombre, $email, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['nombre'] = $nombre;
        echo $twig->render('editarPerfil.html.twig', ['exito' => true, 'nombre' => $nombre, 'email' => $email]);
    } else {
        echo $twig->render('editarPerfil.html.twig', ['error' => "No se pudo actualizar.", 'nombre' => $nombre, 'email' => $email]);
    }
} else {
    $stmt = $conn->prepare("SELECT nombre, email FROM Usuario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nombre, $email);
    $stmt->fetch();

    echo $twig->render('editarPerfil.html.twig', ['nombre' => $nombre, 'email' => $email]);
}

