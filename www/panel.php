<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

echo "<h2>Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "</h2>";

switch ($_SESSION['rol']) {
    case 'normal':
        echo "<h3>Rol: Usuario normal</h3>";
        echo "<p>Puedes comentar películas y editar tu perfil.</p>";
        break;

    case 'moderador':
        echo "<h3>Rol: Moderador</h3>";
        echo "<p>Puedes editar y borrar comentarios.</p>";
        echo '<p><a href="moderar_comentarios.php">Ir al panel de moderación</a></p>';
        break;

    case 'gestor':
        echo "<h3>Rol: Gestor</h3>";
        echo "<p>Gestión disponible:</p>";
        echo "<ul>
                <li><a href='gestionar_peliculas.php'>Gestionar películas</a></li>
                <li><a href='editar_pelicula.php?id=1'>Editar hashtags de una película</a></li>
              </ul>";
        break;

    case 'root':
        echo "<h3>Rol: Administrador (root)</h3>";
        echo "<p>Acceso completo:</p>";
        echo "<ul>
                <li><a href='gestionar_usuarios.php'>Gestionar usuarios y roles</a></li>
                <li><a href='gestionar_peliculas.php'>Gestionar películas</a></li>
                <li><a href='moderar_comentarios.php'>Gestionar comentarios</a></li>
              </ul>";
        break;
}

echo '<p><a href="logout.php">Cerrar sesión</a></p>';
?>

