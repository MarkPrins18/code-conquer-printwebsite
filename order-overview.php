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

//var_dump(array_keys($itemsByOrder));
//print_r($itemsByOrder);

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
            foreach ($orders as $order) {
                $table = new Table();
                $table->setData([$order], 1);  //extra parameter for empty <TD>

                echo $table->renderTable();

                $table = new Table();
                $table->setData($itemsByOrder[$order['order_id']] ?? []);

                echo $table->renderTable();
            }
            ?>

            <?php
            $table = new Table();
            $table->setData($orders, 1);
            //echo $table->renderTable();
            $tableHtml = $table->renderTable();

            $dom = new DOMDocument();
            $dom->loadHTML($tableHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            foreach ($orders as $index => $order) {
                $td = $dom->getElementById("td-row-{$index}");
                
                if ($td) {
                    $button = $dom->createElement('button', 'Bekijk');
                    $button->setAttribute('onclick', "window.location.href += '&order_id={$order['order_id']}'");
                    $td->appendChild($button);
                }
            }

            echo $dom->saveHTML();
            ?>
           
        </section>
    </main>
    <?php include 'layout/footer.php' ?>
</body>
</html>