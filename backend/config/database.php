<?php
// db_connection.php
//require __DIR__ . '/../vendor/autoload.php'; // Ajuste o caminho se necessário
//
//use Dotenv\Dotenv;
//
//$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
//$dotenv->load();
//
//$database = [
//    'host' => getenv('DB_HOST'),
//    'port' => getenv('DB_PORT'),
//    'dbname' => getenv('DB_DATABASE'),
//    'username' => getenv('DB_USERNAME'),
//    'password' => getenv('DB_PASSWORD')
//];

try {
//    $pdo = new PDO(
//        'pgsql:host=' . $database['host'] . ';port=' . $database['port'] . ';dbname=' . $database['dbname'],
//        $database['username'],
//        $database['password']
//    );

    $pdo = new PDO(
        'pgsql:host=localhost;port=5432;dbname=chatapp',
        'postgres',
        ''
    );
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Return $pdo to be used in other files
    return $pdo;
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
