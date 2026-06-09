<?php
$servername = "lamp-mysql8";
$username = "root";
$password = "tiger";
$dbname = "sibw";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
