<?php
// IMPORTAÇÃO DE ARQUIVOS
require_once __DIR__ . '/vendor/autoload.php';

use Controller\MovieController;

$controller = new MovieController();

// ARMAZENA O MÉTODO HTTP
$method = $_SERVER['REQUEST_METHOD'];

// VERIFICAR O MÉTODO E EXECUTAR UMA AÇÃO
switch ($method) {
    case 'GET':
        $controller->getMovies();
        break;
    case 'POST':
        $controller->createMovie();
        break;
    case 'PUT':
        $controller->updateMovie();
        break;
    case 'DELETE':
        $controller->deleteMovie();
        break;
    default:
        echo json_encode(["message" => "Metodo não permitido"]);
        break;
}
?>