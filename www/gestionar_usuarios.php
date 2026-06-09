<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

if ($_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$usuarios = $conn->query("SELECT id, nombre, email, rol FROM Usuario")->fetch_all(MYSQLI_ASSOC);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('gestionar_usuarios.html.twig', [
    'usuarios' => $usuarios,
    'mi_id' => $_SESSION['id']
]);

