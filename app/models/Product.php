<?php

class Product {
    public function __construct(private PDO $pdo) {}

    public function create(string $name, float $price, string $description, string $imgUrl, string $sku, int $stockQuantity): void {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, price, product_type) VALUES (:name, :price, 'standard')");
        $stmt->execute(['name' => $name, 'price' => $price]);
        $productId = (int) $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare(
            "INSERT INTO catalog_products (product_id, description, img_url, sku, stock_quantity) VALUES (:product_id, :description, :img_url, :sku, :stock_quantity)"
        );
        $stmt->execute(['product_id' => $productId, 'description' => $description, 'img_url' => $imgUrl, 'sku' => $sku, 'stock_quantity' => $stockQuantity]);
    }

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
}
