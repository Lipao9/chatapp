<?php
class CreateFriendsTable{
    public static function up(PDO $pdo){
        $sql = "
                    CREATE TABLE IF NOT EXISTS friends (
                        id SERIAL PRIMARY KEY,
                        user_id INT NOT NULL,
                        friend_id INT NOT NULL,
                        status VARCHAR (30) DEFAULT 'pending'
                    );";

        $pdo->exec($sql);
    }

    public static function down($pdo){
        $pdo->exec("DROP TABLE IF EXISTS friends");
    }
}