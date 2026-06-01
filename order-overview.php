<?php
require_once __DIR__. '/config/init.php';
require_once __DIR__. '/translations/order-overview-translations.php';

$stmt = $pdo->prepare("
    SELECT 
        orders.order_id,
        orders.created_at AS bestel_datum,
        order_statuses.label AS status,
        orders.delivery_method,
        orders.delivery_address
    FROM orders
    INNER JOIN order_statuses
        ON order_statuses.status_code = orders.status_code
    WHERE orders.user_id = :user_id
    ORDER BY orders.created_at DESC
    LIMIT 25
");

$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmtItems = $pdo->prepare("
    SELECT 
        order_line_items.order_id,
        products.name,
        order_line_items.quantity,
        order_line_items.unit_price,
        (order_line_items.quantity * order_line_items.unit_price) AS total_price
    FROM order_line_items
    INNER JOIN products
        ON products.product_id = order_line_items.product_id
");

$stmtItems->execute();
$itemsRaw = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

$itemsByOrder = [];

foreach ($itemsRaw as $item) {
    $itemsByOrder[$item['order_id']][] = $item;
}

$orderTotal = 0;
foreach ($itemsRaw as $item) {
    $orderTotal += $item['total_price'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/order-overview.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <script src="assets/js/header.js" defer></script>
    <title>Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>
    <!--This code should be put on any page. The pages needs to have extension .php. Html files can't run php code.-->
    <?php include 'layout/header.php' ?>
    <main>
        <section class="introduction">
            <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['introduction']) ?></h1>
            <table id="orders-table">
                <thead>
                    <tr>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['orderId']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['orderDate']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['status']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['deliveryMethod']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['deliveryAddress']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['orderTotal']) ?></th>
                    </tr>
                </thead>
                <tbody id="orders-body">
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="9"><?= htmlspecialchars($orderOverviewTranslations[$lang]['noOrders']) ?></td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= htmlspecialchars($order['bestel_datum']) ?></td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td><?= htmlspecialchars($order['delivery_method']) ?></td>
                            <td><?= htmlspecialchars($order['delivery_address']) ?></td>
                            <td><?= htmlspecialchars($orderTotal) ?></td>   
                        </tr>

                        <tr>
                            <td colspan="3">

                                <?php foreach ($itemsByOrder[$order['order_id']] ?? [] as $item): ?>
                                    <tr>
                                    <td><?= htmlspecialchars($item['name']) ?></td>  
                                    <td>x<?= $item['quantity'] ?></td>
                                    <td> (€<?= $item['unit_price'] ?>)</td>     
                                    <td>= €<?= $item['total_price'] ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </td>
                        </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
           
        </section>
    </main>
    <?php include 'layout/footer.php' ?>
</body>
</html>