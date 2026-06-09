<?php
session_start();
require_once 'conexion.php';

if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
$estado = $_GET['estado'] ?? null;

if ($id === null || $estado === null) {
    header("Location: gestionar_peliculas.php");
    exit;
}

// Cambiar el estado
$nuevoEstado = $estado == 1 ? 0 : 1;

$stmt = $conn->prepare("UPDATE pelicula SET publicado = ? WHERE id = ?");
$stmt->bind_param("ii", $nuevoEstado, $id);
$stmt->execute();

header("Location: gestionar_peliculas.php");
