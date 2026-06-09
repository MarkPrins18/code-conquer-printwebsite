<?php

class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getOrdersByUserId($userId) {
        $stmt = $this->pdo->prepare("
            SELECT
                orders.order_id,
                orders.created_at AS bestel_datum,
                order_statuses.label AS status,
                orders.delivery_method,
                orders.delivery_address,
                SUM(order_line_items.quantity * order_line_items.unit_price) AS order_total
            FROM orders
            INNER JOIN order_statuses ON order_statuses.status_code = orders.status_code
            INNER JOIN order_line_items ON order_line_items.order_id = orders.order_id
            WHERE orders.user_id = :user_id
            GROUP BY orders.order_id, orders.created_at, order_statuses.label, orders.delivery_method, orders.delivery_address
            ORDER BY orders.created_at DESC
            LIMIT 25
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders() {
        $stmt = $this->pdo->prepare("
            SELECT
                users.email,
                orders.order_id,
                orders.created_at AS bestel_datum,
                order_statuses.label AS status,
                orders.delivery_method,
                orders.delivery_address,
                SUM(order_line_items.quantity * order_line_items.unit_price) AS order_total
            FROM orders
            INNER JOIN order_statuses ON order_statuses.status_code = orders.status_code
            INNER JOIN order_line_items ON order_line_items.order_id = orders.order_id
            INNER JOIN users ON users.user_id = orders.user_id
            GROUP BY orders.order_id, users.email, orders.created_at, order_statuses.label, orders.delivery_method, orders.delivery_address
            ORDER BY orders.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemsByOrderId($orderId) {
        $stmt = $this->pdo->prepare("
            SELECT
                orders.user_id,
                order_line_items.order_id,
                products.name,
                order_line_items.quantity,
                order_line_items.unit_price,
                (order_line_items.quantity * order_line_items.unit_price) AS total_price
            FROM order_line_items
            INNER JOIN products ON products.product_id = order_line_items.product_id
            INNER JOIN orders ON orders.order_id = order_line_items.order_id
            WHERE order_line_items.order_id = :order_id
        ");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
