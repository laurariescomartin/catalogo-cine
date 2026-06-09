<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $idPelicula = $_POST['idPelicula'];
    $fecha = date("Y-m-d H:i:s");

    if (isset($_SESSION['id'])) {
        $idUsuario = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];
        $email = ''; // opcional
    } else {
        $idUsuario = null;
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
    }

    // Filtro de palabrotas
    $palabrotas = $conn->query("SELECT palabra FROM Palabrota");
    while ($p = $palabrotas->fetch_assoc()) {
        $comentario = str_ireplace($p['palabra'], '***', $comentario);
    }

    $stmt = $conn->prepare("INSERT INTO Comentario (idPelicula, nombre_usuario, email, comentario, fecha, idUsuario) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $idPelicula, $nombre, $email, $comentario, $fecha, $idUsuario);
    $stmt->execute();
}

header("Location: ver_pelicula.php?id=$idPelicula");
exit;
