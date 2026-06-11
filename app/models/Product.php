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

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // alternatieve functie bij falen zoekslag
    public function logFailedSearchResults(string $searchTerm) {
        $sql = "INSERT INTO failed_search_results (search_string, updated_at) VALUES (:term, CURRENT_TIMESTAMP)";
        // :term -> $searchTerm 
    }

// searchOrLog gebruiken als wrapper if TRUE = getAll() else if FALSE = logFailedSearchResults()
    public function searchAndLog(string $searchTerm = ''){

        $products = $this->getAll($searchTerm);

        if (empty($products) && !empty($searchTerm)){
            $this->logFailedSearchResults($searchTerm);
        }        
    }

    }

    

