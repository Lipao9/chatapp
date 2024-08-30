<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../migrations/create_users_table.php';

    try {
        $pdo = new PDO('pgsql:host=localhost;dbname=chatapp', 'postgres', '123');
        CreateUsersTable::up($pdo);
        echo "Migration completed successfully.";
    } catch (PDOException $e) {
        echo "Migration failed: " . $e->getMessage();
    }