<?php
    class CreateUsersTable{
        public static function up(PDO $pdo){
            $sql = "
                    CREATE TABLE IF NOT EXISTS users (
                        id SERIAL PRIMARY KEY,
                        name VARCHAR(100) UNIQUE NOT NULL,
                        email VARCHAR(100) UNIQUE NOT NULL,
                        password VARCHAR(255) NOT NULL
                    );";

            $pdo->exec($sql);
        }

        public static function down($pdo){
            $pdo->exec("DROP TABLE IF EXISTS users");
        }
    }