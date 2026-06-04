<?php

class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll($searchTerm = '') {
        $sql = "SELECT products.name, products.price, catalog_products.description, catalog_products.img_url 
            FROM products
            JOIN catalog_products ON products.product_id = catalog_products.product_id";
        
        $params = [];
        if ($searchTerm) {
            $sql .= " WHERE products.name LIKE :term";
            $params = ['term' => '%' . $searchTerm . '%'];
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}