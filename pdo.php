<?php
class Database {
    public static function getConnection() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bouw3d_db";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // CRITICAL: Return the object so the Model can use it
            return $conn; 
            
        } catch(PDOException $e) {
            // Log this error instead of echoing it!
            error_log("Connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed.");
        }
    }
}