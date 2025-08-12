<?php
namespace Controller;

use Model\Movie;

require_once __DIR__ . '/../Config/configuration.php';

class MovieController
{
    // Função para pegar todos os usuários
    public function getMovies()
    {
        $movie = new Movie();
        $movies = $movie->getMovies();

        if ($movies) {
            // Envia a resposta JSON
            header('Content-Type: application/json', true, 200);
            echo json_encode($movies);
        } else {
            header('Content-Type: application/json', true, 404);
            echo json_encode(["message" => "Usuarios nao encontrados"]);
        }
    }

    // Função para criar um usuário
    public function createMovie()
    {
        // Obtém os dados da requisição
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->title) && isset($data->director) && isset($data->year) && isset($data->genre)) {
            $movie = new Movie();
            $movie->title = $data->title;
            $movie->director = $data->director;
            $movie->year = $data->year;
            $movie->genre = $data->genre;
           
            if ($movie->createMovie()) {
                header('Content-Type: application/json', true, 201);
                echo json_encode(["message" => "Usuário criado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao criar usuário"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informação inválida"]);
        }
    }

    // Função para editar um usuário
    public function updateMovie()
    {
        // Obtém os dados da requisição
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->name) && isset($data->email)) {
            $movie = new Movie();
            $movie->id = $data->id;
            $movie->title = $data->title;
            $movie->director = $data->director;
            $movie->year = $data->year;
            $movie->genre = $data->genre;

            if ($movie->updateMovie()) {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Usuario atualizado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao atualizar usuário"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informação invalida"]);
        }
    }

    // Função para excluir um usuário
    public function deleteMovie()
    {
        // Obtém os dados da requisição
        $id = $_GET['id'] ?? null; // Verifica se o ID foi passado na URL

        if ($id) {
            $movie = new Movie();
            $movie->id = $id;

            if ($movie->deleteMovie()) {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Usuario excluído com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);

                echo json_encode(["message" => "Falha ao excluir usuario"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "ID invalido"]);
        }

    }
}

?>