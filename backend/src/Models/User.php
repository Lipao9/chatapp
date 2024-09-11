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

        public function sendInvite($data)
        {
            $friend_id = $this->getFriendId($data['friend']);
            $check_invite = $this->checkInvite($friend_id, $data['user_id']);

            if ($check_invite === 'exists') {
                return json_encode(['mensage' => 'Convite já enviado']);
            }elseif ($check_invite === 'rejected') {
                $this->updateRejectedInvite($friend_id, $data['user_id']);
                return json_encode(['mensage' => 'Convite enviado']);
            }else{
                $stmt = $this->pdo->prepare('INSERT INTO friends (user_id, friend_id) VALUES (:user_id, :friend_id)');
                $stmt->execute([
                    $data['user_id'],
                    $friend_id
                ]);

                if ($stmt->rowCount() > 0) {
                    return json_encode(['mensage' => 'Convite enviado']);
                }else{
                    return json_encode(['mensage' => 'Erro ao enviar convite']);
                }
            }
        }

        public function getFriendId($friend)
        {
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :search OR name = :search");
            $stmt->execute([':search' => $friend]);
            $friend = $stmt->fetch(PDO::FETCH_ASSOC);
            return $friend['id'];
        }

        public function checkInvite($friend_id, $user_id)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM friends WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)");
            $stmt->execute([
                $user_id,
                $friend_id,
                $friend_id,
                $user_id
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result['status'] === 'reject'){
                return 'rejected';
            }

            if ($result) {
                return 'exists';
            }
            return 'send';
        }

        public function updateRejectedInvite($friend_id, $user_id)
        {
            $stmt = $this->pdo->prepare("UPDATE friends SET status = 'pending' WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)");
            $stmt->execute([
                $user_id,
                $friend_id,
                $friend_id,
                $user_id
            ]);
        }

        public function invitesList($user_id)
        {
            $stmt = $this->pdo->prepare("SELECT user_id FROM friends WHERE friend_id = ? AND status = 'pending'");
            $stmt->execute([$user_id]);

            $requesters = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$requesters) {
                return json_encode([]);
            }

            $users = [];

            foreach ($requesters as $requester) {
                $stmt = $this->pdo->prepare("SELECT id, name FROM users WHERE id = :id");
                $stmt->execute([':id' => $requester['user_id']]);
                $users[] = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            return json_encode($users);
        }

        public function respondInvite($data)
        {
            $stmt = $this->pdo->prepare('UPDATE friends SET status = ? WHERE user_id = ? AND friend_id = ?');
            $stmt->execute([
                $data['response'],
                $data['friend_id'],
                $data['user_id']
            ]);

            return json_encode(['mensage' => 'Convite respondido com sucesso!']);
        }
    }