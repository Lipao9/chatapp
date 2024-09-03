<?php

    use App\Controllers\UserController;
    require_once '../vendor/autoload.php';
    require '../config/database.php';

    //$routes = require __DIR__.'/../config/routes.php';

    $pathInfo = $_SERVER['PATH_INFO'] ?? '/';
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $userController = new UserController();

    if ($pathInfo === '/api/user-create'){
        $userController->store($_POST);
    }

    // Verifica se o caminho corresponde ao padrão '/api/user-edit/{id}'
    if (preg_match('/^\/api\/user-edit\/(\d+)/', $requestUri, $matches)) {
        // O ID do usuário está no primeiro grupo de captura
        $userId = $matches[1];
        // Chame o método de edição do objeto $user, passando o ID e os dados POST
        $userController->edit($userId, $_POST);
    }

    // Verifica se o caminho corresponde ao padrão '/api/user-edit/{id}'
    if (preg_match('/^\/api\/user-delete\/(\d+)$/', $requestUri, $matches)) {
        // O ID do usuário está no primeiro grupo de captura
        $userId = $matches[1];
        // Verifique se o método da requisição é POST (ou o método que você usa para edição)
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Chame o método de edição do objeto $user, passando o ID e os dados POST
            $userController->destroy($userId);
        }
    }




