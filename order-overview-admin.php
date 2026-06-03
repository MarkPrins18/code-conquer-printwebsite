<?php
require_once __DIR__. '/config/init.php';
require_once __DIR__. '/translations/order-overview-translations.php';

$stmt = $pdo->prepare("
    SELECT 
        orders.order_id,
        orders.created_at AS bestel_datum,
        order_statuses.label AS status,
        orders.delivery_method,
        orders.delivery_address,
        SUM(order_line_items.quantity * order_line_items.unit_price) AS order_total
    FROM orders
    INNER JOIN order_statuses
        ON order_statuses.status_code = orders.status_code
    INNER JOIN order_line_items
        ON order_line_items.order_id = orders.order_id
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

            <?php
            if (isset($_GET['order_id'])){
                //order details
                $orderId = (int)$_GET['order_id'];
                $table = new Table();
                $table->setData($itemsByOrder[$orderId]);
                $table->autoColumnLabels();
                echo $table->renderTable();
            } else {
            $table = new Table();
            $table->setData($orders);
            // Status aanpassen
            $table->addCustomColumn('status_change', function ($row) {
                $statuses = ['pending', 'processing', 'shipped', 'cancelled'];
                $html = '<form method="POST">';
                $html .= '<input type="hidden" name="order_id" value="' . (int)$row['order_id'] . '">';
                $html .= '<input type="hidden" name="action" value="update_status">';
                $html .= '<select name="status">';
                foreach ($statuses as $status) {
                    $selected = $row['status'] === $status ? 'selected' : '';
                    $html .= '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
                }
                $html .= '</select>';
                $html .= '<button type="submit">Opslaan</button>';
                $html .= '</form>';
                return $html;
            });
            // Verwijderen
            $table->addCustomColumn('delete', function ($row) {
                $html = '<form method="POST">';
                $html .= '<input type="hidden" name="order_id" value="' . (int)$row['order_id'] . '">';
                $html .= '<input type="hidden" name="action" value="delete_order">';
                $html .= '<button type="submit">Verwijderen</button>';
                $html .= '</form>';
                return $html;
            });
            //is the view column still needed?
            $table->addCustomColumn('overview', function ($row) {
            return '<a href="?order_id=' . (int)$row['order_id'] . '">Bekijk</a>';
            });
            $table->autoColumnLabels();
            echo $table->renderTable();
            }
            ?>
           
        </section>
    </main>
    <?php include 'layout/footer.php' ?>
</body>
</html>