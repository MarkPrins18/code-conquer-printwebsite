<?php
//check if these are needed
//require_once __DIR__. '/../config/init.php';
//require_once __DIR__. '/../translations/order-overview-translations.php';

/** @var bool $isDetail */
/** @var array $orders */
/** @var array $items */
/** @var array $orderOverviewTranslations */
/** @var string $lang  */
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
            if ($isDetail == true) {
                //items overview
                $table = new Table();
                $table->setData($items);
                $table->autoColumnLabels();
                echo $table->renderTable();
            } else {
                //orders overview
                $table = new Table();
                $table->setData($orders);
                if ($isAdmin) {
                // Status aanpassen
                $table->addCustomColumn('status_change', function ($row) {
                $statuses = ['Pending', 'Processing', 'Shipped', 'Cancelled'];
                ob_start(); ?>
                <form method="POST" action="order-overview.php">
                    <input type="hidden" name="order_id" value="<?= (int)$row['order_id'] ?>">
                    <input type="hidden" name="action" value="update_status">
                    <select name="status">
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status ?>" <?= $row['status'] === $status ? 'selected' : '' ?>>
                                <?= $status ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Opslaan</button>
                </form>
                <?php return ob_get_clean();
                });
                // Verwijderen
                $table->addCustomColumn('delete', function ($row) {
                ob_start(); ?>
                <form method="POST" action="order-overview.php">
                    <input type="hidden" name="order_id" value="<?= (int)$row['order_id'] ?>">
                    <input type="hidden" name="action" value="delete_order">
                    <button type="submit">Verwijderen</button>
                </form>
                <?php return ob_get_clean();
                });      
                }
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