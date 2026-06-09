<?php
session_start();
require_once 'conexion.php';
require_once 'vendor/autoload.php';

if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $director = $_POST['director'];

    $nombreImagen = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = 'img/peliculas/' . $nombreImagen;
        move_uploaded_file($tmp_name, $rutaDestino);
    }

    $stmt = $conn->prepare("INSERT INTO Pelicula (titulo, descripcion, fecha, director, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $titulo, $descripcion, $fecha, $director, $nombreImagen);
    $stmt->execute();

    header("Location: gestionar_peliculas.php");
    exit;
}

echo $twig->render('nueva_pelicula.html.twig');
