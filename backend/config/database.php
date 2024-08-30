<?php
    return [
        'host' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT'),
        'config' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD')
    ];
//require_once __DIR__ . '/../vendor/autoload.php';
//
//class Database
//{
//    private static ?PDO $pdo = null;
//
//    public static function getConnection(): PDO
//    {
//        if (self::$pdo === null){
//            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
//            $dotenv->load();
//
//            $host = $_ENV['DB_HOST'];
//            $port = $_ENV['DB_PORT'];
//            $dbname = $_ENV['DB_DATABASE'];
//            $user = $_ENV['DB_USERNAME'];
//            $password = $_ENV['DB_PASSWORD'];
//
//            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
//
//            try{
//                self::$pdo = new PDO($dsn, $user, $password);
//                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            }catch(\PDOException $e){
//                throw new RuntimeException('Database connection failed: ' . $e->getMessage());
//            }
//        }
//
//        return self::$pdo;
//    }
//}