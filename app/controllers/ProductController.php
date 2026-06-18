<?php

class ProductController
{
    public function index(): void
    {
        global $productTranslations;
        view('guest/products/index', ['translations' => $productTranslations]);
    }

    public function getJson(): void
    {
        $searchTerm = $_GET['search'] ?? '';

        try {
            $pdo      = Database::getConnection();

            $product  = new Product($pdo);
            $logger = new SearchLog($pdo);

            // products are fetched from the database if there are no results it logs the validated search string to the database 
            $products = $product->getAll($searchTerm);
            $logger->logIfInvalid($searchTerm, $products);
            
        } catch (Exception $e) {
            error_log('Caught: ' . $e);
            $products = [];
        }

        header('Content-Type: application/json');
        echo json_encode($products);
    }
}
