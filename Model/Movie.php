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
        return $stmt;
    }

    public function read_single() {
        $query = "SELECT * FROM movies WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }

    public function createMovie() {
        $query = "INSERT INTO title, director, year, genre) VALUES (:title, :director, :year, :genre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':director', $this->director);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':genre', $this->genre);
        return $stmt->execute();
    }

    public function updateMovie() {
        $query = "UPDATE movies SET title = :title, director = :director, year = :year, genre = :genre WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':director', $this->director);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function deleteMovie() {
        $query = "DELETE FROM movies WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
