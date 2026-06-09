<?php
require_once 'model/BD.php';
session_start();

// Obtener la cadena de búsqueda
$q = $_GET['q'] ?? '';
$q = trim($q);

// Determinar el rol actual
$rol = $_SESSION['rol'] ?? 'anonimo';
$verTodo = ($rol === 'gestor' || $rol === 'root');

// Conectarse a la base de datos y buscar películas
$bd = new BD();
$peliculas = $bd->buscarPeliculas($q, $verTodo);
$bd->cerrar();

// Enviar los resultados como JSON
header('Content-Type: application/json');
echo json_encode($peliculas);
