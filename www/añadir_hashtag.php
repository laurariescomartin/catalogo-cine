<?php
session_start();
require_once 'conexion.php';

if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id_pelicula = $_POST['id_pelicula'];
$nombre = strtolower(trim($_POST['nombre_hashtag']));

// 1. Buscar o crear el hashtag
$stmt = $conn->prepare("SELECT id FROM Hashtag WHERE nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$stmt->bind_result($id_hashtag);
if (!$stmt->fetch()) {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO Hashtag (nombre) VALUES (?)");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $id_hashtag = $conn->insert_id;
}
$stmt->close();

// 2. Insertar en relación si no existe
$stmt = $conn->prepare("INSERT IGNORE INTO Pelicula_Hashtag (id_pelicula, id_hashtag) VALUES (?, ?)");
$stmt->bind_param("ii", $id_pelicula, $id_hashtag);
$stmt->execute();

header("Location: editar_pelicula.php?id=$id_pelicula");
exit;

