<?php

    namespace App\Models;

    use PDO;

    class User{

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
    }