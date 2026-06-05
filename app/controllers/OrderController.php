<?php

class OrderController {
    public function index(): void {
        AuthGuard::requireLogin();
        global $orderOverviewTranslations, $tableTranslations;

        $pdo   = Database::getConnection();
        $model = new Order($pdo);

        if (Session::isAdmin()) {
            $orders = $model->getAllOrders();
        } else {
            $orders = $model->getOrdersByUserId(Session::get('user_id'));
        }

        view('user/orders/index', [
            'isDetail'                  => false,
            'isAdmin'                   => Session::isAdmin(),
            'orders'                    => $orders,
            'orderOverviewTranslations' => $orderOverviewTranslations,
        ]);
    }

    public function show(string $id): void {
        global $orderOverviewTranslations;

        $pdo   = Database::getConnection();
        $model = new Order($pdo);
        $items = $model->getItemsByOrderId((int) $id);

        view('user/orders/index', [
            'isDetail'                  => true,
            'isAdmin'                   => Session::isAdmin(),
            'items'                     => $items,
            'orderOverviewTranslations' => $orderOverviewTranslations,
        ]);
    }
}
