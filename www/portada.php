<?php
require_once '/usr/local/lib/php/vendor/autoload.php';
require_once 'model/BD.php';

$bd = new BD();

$peliculas = $bd->obtenerPeliculasPublicadas();
$bd->cerrar();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig   = new \Twig\Environment($loader);

echo $twig->render('portada.html.twig', [
    'titulo'    => 'Biblioteca Películas',
    'peliculas' => $peliculas
]);
