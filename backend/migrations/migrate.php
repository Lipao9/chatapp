<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../migrations/create_users_table.php';
    require_once __DIR__ . '/../migrations/create_friends_table.php';
    $pdo = require __DIR__ . '/../config/database.php';

    try {
        CreateUsersTable::up($pdo);
        CreateFriendsTable::up($pdo);
        echo "Migration completed successfully.";
    } catch (PDOException $e) {
        echo "Migration failed: " . $e->getMessage();
    }