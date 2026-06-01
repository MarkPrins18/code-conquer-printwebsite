<?php

require_once __DIR__. '/config/init.php';
require_once __DIR__. '/translations/order-overview-translations.php';

$sql = "SELECT 
    orders.order_id,
    orders.created_at                        AS besteldatum,
    order_statuses.label                     AS status,
    orders.delivery_method,
    orders.delivery_address,
    products.name                            AS product_naam,
    order_line_items.quantity,
    order_line_items.unit_price              AS prijs_per_stuk,
    (order_line_items.quantity * order_line_items.unit_price) AS regelprijs

FROM orders 
INNER JOIN order_line_items 
    ON order_line_items.order_id = orders.order_id
INNER JOIN products
    ON order_line_items.product_id = products.product_id
INNER JOIN order_statuses
    ON order_statuses.status_code = orders.status_code
WHERE orders.user_id = :user_id
ORDER BY orders.created_at DESC
LIMIT 25";


$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['product']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['quantity']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['pricePerUnit']) ?></th>
                        <th><?= htmlspecialchars($orderOverviewTranslations[$lang]['linePrice']) ?></th>
                    </tr>
                </thead>
                <tbody id="orders-body">
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="9"><?= htmlspecialchars($orderOverviewTranslations[$lang]['noOrders']) ?></td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['order_id']) ?></td>
                                <td><?= htmlspecialchars($row['besteldatum']) ?></td>
                                <td><?= htmlspecialchars($row['status']) ?></td>
                                <td><?= htmlspecialchars($row['delivery_method']) ?></td>
                                <td><?= htmlspecialchars($row['delivery_address']) ?></td>
                                <td><?= htmlspecialchars($row['product_naam']) ?></td>
                                <td><?= htmlspecialchars($row['quantity']) ?></td>
                                <td>€ <?= number_format($row['prijs_per_stuk'], 2, ',', '.') ?></td>
                                <td>€ <?= number_format($row['regelprijs'], 2, ',', '.') ?></td>
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