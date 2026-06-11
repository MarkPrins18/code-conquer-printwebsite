<?php

class Product {
    public function __construct(private PDO $pdo) {}

    public function getAll(string $searchTerm = ''): array {
        $sql = "SELECT products.name, products.price, catalog_products.description, catalog_products.img_url
                FROM products
                JOIN catalog_products ON products.product_id = catalog_products.product_id";

        $params = [];
        if ($searchTerm !== '') {
            $sql .= " WHERE products.name LIKE :term";
            $params = ['term' => '%' . $searchTerm . '%'];
        }        

error_log("Executing SQL: " . $sql);
error_log("With params: " . json_encode($params));

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    }  
