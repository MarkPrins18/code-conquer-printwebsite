<?php
class Database {
    public static function getConnection() {
        $servername = "localhost";
        $username = "sherwin";
        $password = "";
        $dbname = "bouw3d_db";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;  

        } catch(PDOException $e) {
            // Log this error instead of echoing it!
            error_log("Connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed.");
        }
    }
}