<?php

require_once __DIR__. '/config/init.php';

$servername = "localhost"; //temp replace with PDO
$username = "root";
$password = "";
$dbname = "bouw3d_db";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

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
WHERE orders.user_id = 2
ORDER BY orders.created_at DESC
LIMIT 0, 25";


$stmt = $conn->query($sql);
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
            <h1>Overzicht van bestellingen geplaatst door $bedrijf.</h1>
            <table id="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Besteldatum</th>
                        <th>Status</th>
                        <th>Leveringsmethode</th>
                        <th>Afleveradres</th>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th>Prijs p/st</th>
                        <th>Regelprijs</th>
                    </tr>
                </thead>
                <tbody id="orders-body">
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="9">Geen bestellingen gevonden.</td></tr>
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