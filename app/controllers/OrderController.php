<?php

class OrderController {
    public function index(): void {
        AuthGuard::requireLogin();
        global $orderOverviewTranslations;

        $pdo    = Database::getConnection();
        $model  = new Order($pdo);
        $orders = $model->getOrdersByUserId(Session::get('user_id'));

        view('user/orders/index', [
            'isDetail'                  => false,
            'orders'                    => $orders,
            'orderOverviewTranslations' => $orderOverviewTranslations,
        ]);
    }

    public function show(string $id): void {
        AuthGuard::requireLogin();
        global $orderOverviewTranslations;

        $pdo   = Database::getConnection();
        $model = new Order($pdo);
        $items = $model->getItemsByOrderId((int) $id);

        if (empty($items) || (int) $items[0]['user_id'] !== (int) Session::get('user_id')) {
            http_response_code(403);
            echo '403 - Geen toegang';
            return;
        }

        $items = array_map(function($item) {
            unset($item['user_id']);
            return $item;
        }, $items);

        view('user/orders/index', [
            'isDetail'                  => true,
            'items'                     => $items,
            'orderOverviewTranslations' => $orderOverviewTranslations,
        ]);
    }
}
