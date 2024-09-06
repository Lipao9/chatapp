<?php

namespace App\Controllers;

use App\Models\User;
use PDO;

 class UserController{
        private User $user;
        public function __construct()
        {
            $pdo = require __DIR__ . "/../../config/database.php";
            $this->user = new User($pdo);
        }
         public function store($data): false|string
         {
            $this->user->create($data);
            return json_encode(['success' => 'success']);
        }

        public function edit(int $id, $data): false|string
        {
            $this->user->update($id, $data);
            return json_encode(['status' => 'success']);
        }

        public function destroy(int $id): false|string
        {
            $this->user->delete($id);
            return json_encode(['status' => 'success']);
        }

         public function login($data)
         {
             $this->user->login($data);
             echo json_encode(['status' => 'success', 'message' => 'Login success']);
         }

         public function checkAuth()
         {
            $userLogged = $this->user->checkAuth();

            if ($userLogged) {
                echo json_encode(['status' => 'success', 'user' => $userLogged]);
            }else{
                echo json_encode(['status' => 'fail', 'message' => 'Login fail']);
            }
         }

         public function logout()
         {
            $this->user->logout();
            echo json_encode(['status' => 'success', 'message' => 'Logout success']);
         }
    }