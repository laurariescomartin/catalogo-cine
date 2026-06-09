<?php
session_start();
require_once 'conexion.php';

if ($_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit;
}

$id = $_POST['id'];
$nuevo_rol = $_POST['nuevo_rol'];

// Evitar dejar el sistema sin root
if ($nuevo_rol !== 'root') {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM Usuario WHERE rol = 'root'");
    $stmt->execute();
    $stmt->bind_result($numRoots);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conn->prepare("SELECT rol FROM Usuario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($rol_actual);
    $stmt->fetch();
    $stmt->close();

    if ($rol_actual === 'root' && $numRoots <= 1) {
        echo "⚠️ No puedes quitarte a ti mismo el rol root si eres el único.";
        exit;
    }
}

$stmt = $conn->prepare("UPDATE Usuario SET rol = ? WHERE id = ?");
$stmt->bind_param("si", $nuevo_rol, $id);
$stmt->execute();

header("Location: gestionar_usuarios.php");
exit;
