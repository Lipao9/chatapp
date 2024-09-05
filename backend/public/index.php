<?php
    header("Access-Control-Allow-Origin: *"); // Permite todas as origens; ajuste conforme necessário
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    use App\Controllers\UserController;
    require_once '../vendor/autoload.php';
    require '../config/database.php';

    $pathInfo = $_SERVER['PATH_INFO'] ?? '/';
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $userController = new UserController();

    if ($pathInfo === '/api/user-create'){
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $userController->store($data);
    }

    if (str_starts_with($requestUri, '/api/login')) {
        if (isset($_GET['email']) && isset($_GET['password'])) {
            $data = [
                'email' => $_GET['email'],
                'password' => $_GET['password']
            ];

            $userController->getId($data);
        } else {
            echo "Parâmetros 'email' e 'password' não foram fornecidos.";
        }
    }

    // Verifica se o caminho corresponde ao padrão '/api/user-edit/{id}'
    if (preg_match('/^\/api\/user-edit\/(\d+)/', $requestUri, $matches)) {
        // O ID do usuário está no primeiro grupo de captura
        $userId = $matches[1];
        // Chame o método de edição do objeto $user, passando o ID e os dados POST
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $userController->edit($userId, $data);
    }

    // Verifica se o caminho corresponde ao padrão '/api/user-edit/{id}'
    if (preg_match('/^\/api\/user-delete\/(\d+)$/', $requestUri, $matches)) {
        // O ID do usuário está no primeiro grupo de captura
        $userId = $matches[1];
        // Verifique se o método da requisição é POST (ou o método que você usa para edição)
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Chame o método de edição do objeto $user, passando o ID e os dados POST
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            $userController->destroy($data);
        }
    }







