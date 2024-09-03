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
    }