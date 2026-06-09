<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

// Verificar permisos
if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$busqueda = $_GET['q'] ?? '';
$peliculas = [];

if ($busqueda) {
    $busqueda = "%$busqueda%";
    $stmt = $conn->prepare("SELECT id, titulo, descripcion, imagen, publicado FROM pelicula WHERE titulo LIKE ? OR descripcion LIKE ?");
    $stmt->bind_param("ss", $busqueda, $busqueda);
    $stmt->execute();
    $result = $stmt->get_result();
    $peliculas = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $result = $conn->query("SELECT id, titulo, descripcion, imagen, publicado FROM pelicula ORDER BY id DESC");
    $peliculas = $result->fetch_all(MYSQLI_ASSOC);
}

// Cargar Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Renderizar la plantilla
echo $twig->render('gestionar_peliculas.html.twig', [
    'peliculas' => $peliculas,
    'session' => $_SESSION
]);
