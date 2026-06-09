<?php
session_start();
require_once 'conexion.php';

if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM Pelicula WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: gestionar_peliculas.php");
exit;
