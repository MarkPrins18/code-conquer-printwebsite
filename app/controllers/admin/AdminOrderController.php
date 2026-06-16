<?php

class AdminOrderController {
    public function index(): void {
        AuthGuard::requireAdmin();
        global $orderOverviewTranslations;

        $pdo      = Database::getConnection();
        $model    = new Order($pdo);
        $orders   = $model->getAllOrders();
        $statuses = $model->getStatuses();

        view('admin/orders/index', [
            'isDetail'                  => false,
            'orders'                    => $orders,
            'statuses'                  => $statuses,
            'orderOverviewTranslations' => $orderOverviewTranslations,
        ]);
    }

    public function show(string $id): void {
        AuthGuard::requireAdmin();
        global $orderOverviewTranslations;

        $pdo   = Database::getConnection();
        $model = new Order($pdo);
        $items = $model->getItemsByOrderId((int) $id);

        $items = array_map(function ($item) {
            unset($item['user_id']);
            return $item;
        }, $items);

        view('admin/orders/index', [
            'isDetail'                  => true,
            'items'                     => $items,
            'orderOverviewTranslations' => $orderOverviewTranslations,
        ]);
    }

    public function updateStatus(): void {
        AuthGuard::requireAdmin();

        $orderId    = (int) ($_POST['order_id'] ?? 0);
        $statusCode = trim($_POST['status_code'] ?? '');

        if ($orderId > 0 && $statusCode !== '') {
            $pdo   = Database::getConnection();
            $model = new Order($pdo);
            $model->updateStatus($orderId, $statusCode);
            Session::flash('success', 'Bestelstatus bijgewerkt.');
        }

        header('Location: ' . BASE_URL . '/admin/orders');
        exit;
    }

    public function deleteOrder(): void {
        AuthGuard::requireAdmin();

        $orderId = (int) ($_POST['order_id'] ?? 0);

        if ($orderId > 0) {
            $pdo   = Database::getConnection();
            $model = new Order($pdo);
            $model->deleteOrder($orderId);
            Session::flash('success', 'Bestelling verwijderd.');
        }

        header('Location: ' . BASE_URL . '/admin/orders');
        exit;
    }
}
