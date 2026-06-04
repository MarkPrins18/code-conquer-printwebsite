<?php
require_once __DIR__. '/config/init.php';
require_once __DIR__. '/translations/order-overview-translations.php';
require_once __DIR__. '/classes/order-model.php';
require_once __DIR__. '/includes/order-controller.php';

//session_destroy();

$pdo = Database::getConnection();
$orderModel = new OrderModel($pdo);
$orderController = new OrderController($orderModel);
$orderController->handleRequest();