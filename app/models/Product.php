<?php

class Product {
    public function __construct(private PDO $pdo) {}

    public function create(string $name, float $price, string $description, string $imgUrl, string $sku, int $stockQuantity): void {
        // Here we group the two queries and only commit (permanently save the changes) if both queries ran succesfully. With rollback, we undo it all.
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("INSERT INTO products (name, price, product_type) VALUES (:name, :price, 'standard')");
            $stmt->execute(['name' => $name, 'price' => $price]);
            $productId = (int) $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare(
                "INSERT INTO catalog_products (product_id, description, img_url, sku, stock_quantity) VALUES (:product_id, :description, :img_url, :sku, :stock_quantity)"
            );
            $stmt->execute(['product_id' => $productId, 'description' => $description, 'img_url' => $imgUrl, 'sku' => $sku, 'stock_quantity' => $stockQuantity]);

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function upsertByName(string $name, float $price, string $description, string $imgUrl, string $sku, int $stockQuantity): void {
        $stmt = $this->pdo->prepare(
            "SELECT products.product_id FROM products
             JOIN catalog_products ON products.product_id = catalog_products.product_id
             WHERE products.name = :name LIMIT 1"
        );
        $stmt->execute(['name' => $name]);
        $existing = $stmt->fetch();

        $this->pdo->beginTransaction();
        try {
            if ($existing) {
                $id = $existing['product_id'];
                $stmt = $this->pdo->prepare("UPDATE products SET price = :price WHERE product_id = :id");
                $stmt->execute(['price' => $price, 'id' => $id]);
                $stmt = $this->pdo->prepare(
                    "UPDATE catalog_products SET description = :description, img_url = :img_url, sku = :sku, stock_quantity = :stock_quantity WHERE product_id = :id"
                );
                $stmt->execute(['description' => $description, 'img_url' => $imgUrl, 'sku' => $sku, 'stock_quantity' => $stockQuantity, 'id' => $id]);
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO products (name, price, product_type) VALUES (:name, :price, 'standard')");
                $stmt->execute(['name' => $name, 'price' => $price]);
                $id = (int) $this->pdo->lastInsertId();
                $stmt = $this->pdo->prepare(
                    "INSERT INTO catalog_products (product_id, description, img_url, sku, stock_quantity) VALUES (:product_id, :description, :img_url, :sku, :stock_quantity)"
                );
                $stmt->execute(['product_id' => $id, 'description' => $description, 'img_url' => $imgUrl, 'sku' => $sku, 'stock_quantity' => $stockQuantity]);
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
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
