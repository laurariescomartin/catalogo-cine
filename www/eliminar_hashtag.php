<?php
session_start();
require_once 'conexion.php';

if ($_SESSION['rol'] !== 'gestor' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id_pelicula = $_GET['id_pelicula'];
$nombre = $_GET['hashtag'];

$stmt = $conn->prepare("SELECT id FROM Hashtag WHERE nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$stmt->bind_result($id_hashtag);
$stmt->fetch();
$stmt->close();

if ($id_hashtag) {
    $stmt = $conn->prepare("DELETE FROM Pelicula_Hashtag WHERE id_pelicula = ? AND id_hashtag = ?");
    $stmt->bind_param("ii", $id_pelicula, $id_hashtag);
    $stmt->execute();
}

header("Location: editar_pelicula.php?id=$id_pelicula");
exit;
