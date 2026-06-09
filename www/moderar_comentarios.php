<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

if ($_SESSION['rol'] !== 'moderador' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$comentarios = $conn->query("SELECT * FROM Comentario ORDER BY fecha DESC")->fetch_all(MYSQLI_ASSOC);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('moderar_comentarios.html.twig', ['comentarios' => $comentarios]);

