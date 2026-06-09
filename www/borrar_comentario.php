<?php
session_start();
require_once 'conexion.php';

if ($_SESSION['rol'] !== 'moderador' && $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM Comentario WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: moderar_comentarios.php");
exit;
