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

        if ($chatId) {
            // Atribuir o chatId à conexão
            $conn->chatId = $chatId;

            // Inicializar a sala de chat se ainda não existir
            if (!isset($this->chatRooms[$chatId])) {
                $this->chatRooms[$chatId] = new \SplObjectStorage;
            }

            // Adicionar a conexão à sala de chat correspondente
            $this->chatRooms[$chatId]->attach($conn);
            echo "Nova conexão na sala de chat {$chatId} (ID: {$conn->resourceId})\n";
        } else {
            echo "Nova conexão sem chatId (ID: {$conn->resourceId})\n";
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        if (isset($from->chatId) && isset($this->chatRooms[$from->chatId])) {
            foreach ($this->chatRooms[$from->chatId] as $client) {
                if ($from !== $client) {
                    $client->send($msg);
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
