<?php

class Database {
    public static function getConnection(): PDO {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=bouw3d_db;charset=utf8mb4', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            error_log('Connection failed: ' . $e->getMessage());
            throw new Exception('Database connection failed.');
        }
    }
}