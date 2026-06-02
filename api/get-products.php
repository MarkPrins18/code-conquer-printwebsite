<?php
// PDO VERVANGEN MET PERMANENTE PDO
require_once '../includes/pdo.php'; 
require_once '../classes/product-class.php';
require_once '../includes/product-controller.php';

$productModel = new Product(Database::getConnection());
$controller = new ProductController($productModel);

$searchTerm = $_GET['search'] ?? '';
    try{
        $products = $controller->handleRequest($searchTerm);

    } catch (Exception $e) {
        error_log("Caught: $e");
        $products = [];    
    }

header('Content-Type: application/json');
echo json_encode($products);