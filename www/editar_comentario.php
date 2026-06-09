<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

if ($_SESSION['rol'] !== 'moderador' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo = $_POST['comentario'];
    $stmt = $conn->prepare("UPDATE Comentario SET comentario = ?, editado_por_moderador = 1 WHERE id = ?");
    $stmt->bind_param("si", $nuevo, $id);
    $stmt->execute();
    header("Location: moderar_comentarios.php");
    exit;
}

$stmt = $conn->prepare("SELECT comentario FROM Comentario WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($comentario);
$stmt->fetch();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('editar_comentario.html.twig', ['comentario' => $comentario, 'id' => $id]);

