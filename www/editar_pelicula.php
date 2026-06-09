<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID de película no especificado.");
}

// Obtener datos actuales de la película
$stmt = $conn->prepare("SELECT * FROM pelicula WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$pelicula = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $publicado = isset($_POST['publicado']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE pelicula SET titulo = ?, descripcion = ?, publicado = ? WHERE id = ?");
    $stmt->bind_param("ssii", $titulo, $descripcion, $publicado, $id);
    $stmt->execute();

    header("Location: gestionar_peliculas.php");
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('editar_pelicula.html.twig', [
    'pelicula' => $pelicula,
    'session' => $_SESSION
]);
