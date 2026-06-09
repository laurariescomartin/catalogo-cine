<?php
session_start();
require_once 'model/BD.php';
require_once '/usr/local/lib/php/vendor/autoload.php';

$id = $_GET['id'] ?? null;
$query = $_GET['q'] ?? '';

if (!$id) {
    die("ID de película no especificado.");
}

$bd = new BD();
$pelicula = $bd->obtenerPeliculaPorId($id);
$comentarios = $bd->obtenerComentariosPelicula($id) ?? [];
$hashtags = $bd->obtenerHashtagsPelicula($id);      
$bd->cerrar();

$rol = $_SESSION['rol'] ?? 'anonimo';

if ($pelicula['publicado'] == 0 && $rol !== 'gestor' && $rol !== 'root') {
    die("Esta película no está publicada.");
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('ver_pelicula.html.twig', [
    'pelicula' => $pelicula,
    'comentarios' => $comentarios,
    'hashtags' => $hashtags,
    'rol' => $rol,
    'query' => $query
]);
