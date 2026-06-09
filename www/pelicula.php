<?php
require_once '/usr/local/lib/php/vendor/autoload.php';

// Conexión a BD
$servername = "lamp-mysql8";
$username = "root";
$password = "tiger";
$dbname = "sibw";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Leer ID de película
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Procesar formulario (insertar comentario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $texto = trim($_POST['comentario']);

    if ($nombre && filter_var($email, FILTER_VALIDATE_EMAIL) && $texto && $id > 0) {
        $stmt = $conn->prepare("INSERT INTO comentario (idPelicula, nombre_usuario, email, comentario, fecha) VALUES (?, ?, ?, ?, NOW())");
        if (!$stmt) {
            die("Error preparando la consulta: " . $conn->error);
        }
        $stmt->bind_param("isss", $id, $nombre, $email, $texto);
        $stmt->execute();
        $stmt->close();
    }
}

// Obtener datos de película
$stmt = $conn->prepare("SELECT id, titulo, fecha, director, descripcion, actores, enlace_imdb, enlace_wiki, imagenes FROM pelicula WHERE id = ?");
if (!$stmt) {
    die("Error preparando la consulta de película: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$peliculaResult = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$peliculaResult) {
    die("Película no encontrada.");
}

// Si hay una cadena de nombres de imágenes separadas por comas
$imagenes = [];
if (!empty($peliculaResult['imagenes'])) {
    $nombres = explode(',', $peliculaResult['imagenes']);
    foreach ($nombres as $nombre) {
        $imagenes[] = [
            'descripcion' => $nombre,
            'ruta' => 'images/' . trim($nombre)
        ];
    }
}

// Obtener comentarios
$stmt = $conn->prepare("SELECT nombre_usuario, comentario, fecha FROM comentario WHERE idPelicula = ? ORDER BY fecha DESC");
if (!$stmt) {
    die("Error preparando la consulta de comentarios: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$comentarios = [];

while ($row = $res->fetch_assoc()) {
    $comentarios[] = [
        'nombre_usuario' => $row['nombre_usuario'],
        'comentario' => $row['comentario'],
        'fecha' => $row['fecha']
    ];
}
$stmt->close();

// Obtener lista de palabrotas de la base de datos
$palabras_prohibidas = [];
$result = $conn->query("SELECT palabra FROM Palabrota");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $palabras_prohibidas[] = $row['palabra'];
    }
    $result->free();
}

// Función para filtrar palabrotas en un texto reemplazándolas por asteriscos
function filtrar_palabras($texto, $lista_palabras) {
    foreach ($lista_palabras as $palabra) {
        $regex = '/\b' . preg_quote($palabra, '/') . '\b/i';
        $reemplazo = str_repeat('*', mb_strlen($palabra));
        $texto = preg_replace($regex, $reemplazo, $texto);
    }
    return $texto;
}

// Aplicar filtro a todos los comentarios
foreach ($comentarios as &$comentario) {
    $comentario['comentario'] = filtrar_palabras($comentario['comentario'], $palabras_prohibidas);
}
unset($comentario);

// Twig (usa la carpeta "templates")
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('pelicula.html.twig', [
    'titulo' => $peliculaResult['titulo'],
    'pelicula' => $peliculaResult,
    'comentarios' => $comentarios,
    'imagenes' => $imagenes
]);
?>
