<?php
//check if these are needed
//require_once __DIR__. '/../../lang/order-overview-translations.php';

/** @var bool $isDetail */
/** @var array $orders */
/** @var array $items */
/** @var array $orderOverviewTranslations */
/** @var string $lang  */
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="/assets/css/global.css" />
    <link rel="stylesheet" href="/assets/css/components.css" />
    <link rel="stylesheet" href="/assets/css/order-overview.css" />
    <link rel="stylesheet" href="/assets/css/header-footer.css" />
    <script src="/assets/js/header.js" defer></script>
    <title>Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico" />
</head>
<body>
    <!--This code should be put on any page. The pages needs to have extension .php. Html files can't run php code.-->
    <?php include __DIR__ . '/../../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <?php if ($isDetail == true): ?>
            <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['order_details']) ?></h1>
            <a id="backlink" href="/orders">
                <?= htmlspecialchars($orderOverviewTranslations[$lang]['back']) ?>
            </a>
            <?php else: ?>
                <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['introduction']) ?></h1>
            <?php endif; ?>

            <?php
            if ($isDetail == true) {
                $table = new Table();
                $table->setData($items);
                $table->autoColumnLabels();
                echo $table->renderTable();
            } else {
                $table = new Table();
                $table->setData($orders);
                if ($isAdmin) {
                $table->addCustomColumn('status_change', function ($row) {
                $statuses = ['Pending', 'Order Received', 'Processing', 'Payment Confirmed', 'Preparing Shipment', 'Shipped', 'In Transit', 'Out for Delivery', 'Delivered', 'Cancelled', 'Returned', 'Refunded'];
                ob_start(); ?>
                <form method="POST" action="/orders">
                    <input type="hidden" name="order_id" value="<?= (int)$row['order_id'] ?>">
                    <input type="hidden" name="action" value="update_status">
                    <select name="status" class="status-select">
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status ?>" <?= $row['status'] === $status ? 'selected' : '' ?>>
                                <?= $status ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-save">Opslaan</button>
                </form>
                <?php return ob_get_clean();
                });
                $table->addCustomColumn('delete', function ($row) {
                ob_start(); ?>
                <form method="POST" action="/orders">
                    <input type="hidden" name="order_id" value="<?= (int)$row['order_id'] ?>">
                    <input type="hidden" name="action" value="delete_order">
                    <button type="submit" class="btn btn-delete">Verwijderen</button>
                </form>
                <?php return ob_get_clean();
                });
                }
                $table->addCustomColumn('overview', function ($row) {
                    return '<a class="btn btn-view" href="/orders/' . (int)$row['order_id'] . '">Bekijk</a>';
                });
                $table->autoColumnLabels();
                echo $table->renderTable();
            }

            ?>

        </section>
    </main>
    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
