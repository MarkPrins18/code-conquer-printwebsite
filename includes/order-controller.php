<?php

class OrderController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function handleRequest() {
        $isDetail = isset($_GET['order_id']);
        $isAdmin    = ($_SESSION['role_name'] ?? '') === 'Admin';
        $isAdmin = true;
        if (isset($_GET['order_id'])){
            //order details
            $orderId = (int)$_GET['order_id'];
            $items = $this->model->getItemsByOrderId($orderId);
        } else {
            //order overview
            if ($isAdmin) {
                $orders = $this->model->getAllOrders();
            } else {
                $orders = $this->model->getOrdersByUserId($_SESSION['user_id']);
            }
        }

        $lang = $_SESSION['lang'] ?? 'nl';
        require __DIR__ . '/../translations/order-overview-translations.php';
        require __DIR__ . '/../translations/header-footer-translations.php';
        require __DIR__ . '/../view/order-overview.php';
    }
}
?>