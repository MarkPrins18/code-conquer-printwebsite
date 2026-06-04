<?php

class ProductController {
    public function index(): void {
        view('products/index');
    }

    public function getJson(): void {
        $searchTerm = $_GET['search'] ?? '';

        try {
            $pdo      = Database::getConnection();
            $product  = new Product($pdo);
            $products = $product->getAll($searchTerm);
        } catch (Exception $e) {
            error_log('Caught: ' . $e);
            $products = [];
        }

        header('Content-Type: application/json');
        echo json_encode($products);
    }
}
