<?php
class BD {
    private $conn;

    public function __construct() {
        $servername = "lamp-mysql8";
        $username = "root";
        $password = "tiger";
        $dbname = "sibw";
        $port = 3306;

        $this->conn = new mysqli($servername, $username, $password, $dbname, $port);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function obtenerPeliculas() {
        $peliculas = [];
        $res = $this->conn->query("SELECT id, titulo, imagen FROM pelicula");

        while ($row = $res->fetch_assoc()) {
            $peliculas[] = $row;
        }
        return $peliculas;
    }

    public function obtenerPeliculasPublicadas() {
        $peliculas = [];
        $sql = "SELECT id, titulo, descripcion, imagen FROM pelicula WHERE publicado = 1 ORDER BY id DESC";
        $res = $this->conn->query($sql);

        while ($row = $res->fetch_assoc()) {
            $peliculas[] = $row;
        }
        return $peliculas;
    }
    
    public function obtenerPeliculaPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM pelicula WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }
    
    public function buscarPeliculas($q, $verTodo = false) {
        $peliculas = [];
        $like = '%' . $q . '%';

        if ($verTodo) {
            $stmt = $this->conn->prepare("SELECT id, titulo FROM pelicula WHERE titulo LIKE ?");
        } else {
            $stmt = $this->conn->prepare("SELECT id, titulo FROM pelicula WHERE publicado = 1 AND titulo LIKE ?");
        }

        $stmt->bind_param("s", $like);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $peliculas[] = $row;
        }

        return $peliculas;
    }
    
    public function obtenerComentariosPelicula($idPelicula) {
        $stmt = $this->conn->prepare("SELECT * FROM Comentario WHERE idPelicula = ?");
        $stmt->bind_param("i", $idPelicula);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $comentarios = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $comentarios;
    }

    public function obtenerHashtagsPelicula($idPelicula) {
        $hashtags = [];
        $sql = "SELECT h.nombre 
                FROM Hashtag h 
                JOIN Pelicula_Hashtag ph ON h.id = ph.id_hashtag 
                WHERE ph.id_pelicula = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idPelicula);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $hashtags[] = $row['nombre'];
        }

        return $hashtags;
    }


    public function cerrar() {
        $this->conn->close();
    }
}
?>
