<?php
namespace Model;
use PDO;
use Model\Connection;

require_once __DIR__ . '/../Config/configuration.php';

class Movie {
    private $conn;

    public $id;
    public $title;
    public $director;
    public $year;
    public $genre;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function getMovies() {
        $query = "SELECT * FROM movies";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function read_single() {
    $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    return $stmt;
}

    public function createMovie() {
        $query = "INSERT INTO movies (title, director, year, genre) VALUES (:title, :director, :year, :genre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':director', $this->director, PDO::PARAM_STR);
        $stmt->bindParam(':year', $this->year, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $this->genre, PDO::PARAM_STR);
         if ($stmt->execute()) {
            return true;
        }

        return false;
    
}
        
    public function updateMovie() {
        $query = "UPDATE movies SET title = :title, director = :director, year = :year, genre = :genre WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':director', $this->director, PDO::PARAM_STR);
        $stmt->bindParam(':year', $this->year, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $this->genre, PDO::PARAM_STR);
        
        if ($stmt->execute()){
            return true;
        }

        return false;

    }

    public function deleteMovie() {
        $query = "DELETE FROM movies WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
