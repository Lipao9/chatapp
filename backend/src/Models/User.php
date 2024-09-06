<?php

    namespace App\Models;

    use PDO;

    class User
    {

        private PDO $pdo;
        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create($data): void
        {
            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_BCRYPT)
            ]);
        }

        public function update($id, $data): void
        {
            $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');
            $stmt->execute([
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
                ':id' => $id
            ]);
        }

        public function delete($id): void
        {
            $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute([':id' => $id]);
        }

        public function login($data)
        {
            session_start();
            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute([':email' => $data['email']]);
            $user = $stmt->fetch();

            if ($user && password_verify($data['password'], $user['password'])) {
                $_SESSION['user'] = [
                   'id' => $user['id'],
                   'name' => $user['name'],
                ];
            }else {
                http_response_code(401);
            }
        }

        public function checkAuth()
        {
            session_start();

            if (isset($_SESSION['user'])) {
                return $_SESSION['user'] ;
            }else{
                return false;
            }
        }

        public function logout()
        {
            session_start();
            session_destroy();
        }
    }