<?php
$host = 'localhost';
$db   = 'bouw3d_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $searchTerm = $_GET['search'] ?? '';

    $sql = "SELECT products.name, products.price, catalog_products.description 
            FROM products
            JOIN catalog_products ON products.product_id = catalog_products.product_id";

    // :term prevents the user from SQL injection > :term is replaced by the $searchTerm as text when executing
    if ($searchTerm) {
        $sql .= " WHERE products.productname LIKE :term";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['term' => '%' . $searchTerm . '%']);
    } else {
        $stmt = $pdo->query($sql);
    }

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($products);

} catch (PDOException $e) {
     header('Content-Type: application/json', true, 500);
     echo json_encode(['error' => 'Database connection failed']);
     //!!! DELETEN ALS ALLES WERKT !!!
     // This will now show the REAL error message in your browser
    // echo json_encode(['error' => 'Detailed error: ' . $e->getMessage()]);
 }

?>