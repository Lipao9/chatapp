<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;
use Psr\Http\Message\RequestInterface;

require '../vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $chatRooms;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->chatRooms = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        // Obter a URI da conexão
        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryParams);
        $chatId = $queryParams['chatId'] ?? null;
        $userId = $queryParams['userId'] ?? null;

        if ($chatId) {
            // Atribuir o chatId à conexão
            $conn->chatId = $chatId;
            $conn->userId = $userId;

            // Inicializar a sala de chat se ainda não existir
            if (!isset($this->chatRooms[$chatId.'-'.$userId]) && !isset($this->chatRooms[$userId.'-'.$chatId])) {
                $this->chatRooms[$chatId.'-'.$userId] = new \SplObjectStorage;
                $this->chatRooms[$chatId.'-'.$userId]->attach($conn);
            }

            if (isset($this->chatRooms[$userId.'-'.$chatId])) {
                $this->chatRooms[$userId.'-'.$chatId]->attach($conn);
            }

          //  echo $this->chatRooms[$chatId.'-'.$userId];
            echo "Nova conexão na sala de chat {$chatId} (ID: {$conn->resourceId})\n";
        } else {
            echo "Nova conexão sem chatId (ID: {$conn->resourceId})\n";
        }
    }

//    public function onMessage(ConnectionInterface $from, $msg) {
//        if (isset($from->chatId) && isset($this->chatRooms[$from->chatId])) {
//            foreach ($this->chatRooms[$from->chatId] as $client) {
//                if ($from !== $client) {
//                    $client->send($msg);
//                }
//            }
//        }
//    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        // Verificar se os dados contêm o tipo e conteúdo da mensagem
        if (isset($msg)) {
            $chatId = $from->chatId;
            $userId = $from->userId;

            // Criar a mensagem a ser enviada
//            $message = [
//                'userId' => $userId,
//                'message' => $msg,
//                'timestamp' => time()
//            ];

            // Enviar a mensagem para todos os usuários na sala de chat correspondente
            if (isset($this->chatRooms[$chatId.'-'.$userId])) {
                foreach ($this->chatRooms[$chatId.'-'.$userId] as $client) {
                    // Não enviar a mensagem de volta para quem a enviou
                    if ($from !== $client) {
                        $client->send($msg);
                    }
                }
            } elseif (isset($this->chatRooms[$userId.'-'.$chatId])) {
                foreach ($this->chatRooms[$userId.'-'.$chatId] as $client) {
                    // Não enviar a mensagem de volta para quem a enviou
                    if ($from !== $client) {
                        $client->send($msg);
                    }
                }
            }
        }
    }


    public function onClose(ConnectionInterface $conn) {
        if (isset($conn->chatId) && isset($this->chatRooms[$conn->chatId])) {
            $this->chatRooms[$conn->chatId]->detach($conn);
            echo "Conexão {$conn->resourceId} desconectada da sala de chat {$conn->chatId}\n";

            // Remover a sala de chat se estiver vazia
            if (count($this->chatRooms[$conn->chatId]) === 0) {
                unset($this->chatRooms[$conn->chatId]);
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Ocorreu um erro: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();
