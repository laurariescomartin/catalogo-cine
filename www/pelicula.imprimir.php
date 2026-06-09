<?php
require_once '/usr/local/lib/php/vendor/autoload.php';
require_once 'model/BD.php';

// Validar y obtener el ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID de película no válido.");
}

// Obtener datos desde la base de datos
$bd = new BD();
$pelicula = $bd->obtenerPeliculaPorId($id);
$bd->cerrar();

if (!$pelicula) {
    die("Película no encontrada.");
}

// Cargar plantilla Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('pelicula.imprimir.html.twig', [
    'pelicula' => $pelicula,
    'titulo' => $pelicula['titulo']
]);

