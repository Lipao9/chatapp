<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Allow-Credentials: true");

    use App\Controllers\UserController;
    require_once '../vendor/autoload.php';
    require '../config/database.php';

    $pathInfo = $_SERVER['PATH_INFO'] ?? '/';
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $userController = new UserController();

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    if ($pathInfo === '/api/user-create'){
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $userController->store($data);
    }

    if ($pathInfo === '/api/login'){
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $userController->login($data);
    }

    if ($pathInfo === '/api/check-auth'){
        $userController->checkAuth();
    }

    if ($pathInfo === '/api/logout'){
        $userController->logout();
    }

    if ($pathInfo === '/api/add-friend'){
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $userController->addFriend($data);
    }

    if ($pathInfo === '/api/invites'){
        $user_id = $_GET['user_id'];
        $userController->invitesList($user_id);
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







