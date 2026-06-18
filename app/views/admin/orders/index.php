<?php
/** @var bool $isDetail */
/** @var array $orders */
/** @var array $items */
/** @var array $statuses */
/** @var array $orderOverviewTranslations */
/** @var string $lang */
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/order-overview.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/order-filter.js" defer></script>
    <title>Admin – Bestellingen</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>

<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <?php if ($isDetail): ?>
                <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['orderDetails']) ?></h1>
                <a id="backlink" href="<?= BASE_URL ?>/admin/orders">
                    <?= htmlspecialchars($orderOverviewTranslations[$lang]['back']) ?>
                </a>
                <?php
                    $table = new Table();
                    $table->setData($items);
                    $table->autoColumnLabels();
                    echo $table->renderTable();
                ?>
            <?php else: ?>
                <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['orders']) ?></h1>
                <?php $successMsg = Session::getFlash('success'); ?>
                <?php if ($successMsg): ?>
                    <p class="success"><?= htmlspecialchars($successMsg) ?></p>
                <?php endif; ?>

                <?php if (empty($orders)): ?>
                    <p><?= htmlspecialchars($orderOverviewTranslations[$lang]['noOrders']) ?></p>
                <?php else: ?>
                    <?php $showSearch = true; include __DIR__ . '/../../components/order-filter.php'; ?>

                    <?php
                        $table = new Table();
                        $table->setData($orders);
                        $table->addCustomColumn('status_wijzigen', function ($row) use ($statuses, $orderOverviewTranslations, $lang) {
                            ob_start(); ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/orders/update-status">
                                <input type="hidden" name="order_id" value="<?= (int) $row['order_id'] ?>">
                                <select name="status_code" class="status-select">
                                    <?php foreach ($statuses as $status): ?>
                                        <option value="<?= htmlspecialchars($status['status_code']) ?>"
                                            <?= $row['status'] === $status['label'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($status['label']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-save">
                                    <?= htmlspecialchars($orderOverviewTranslations[$lang]['save']) ?>
                                </button>
                            </form>
                            <?php return ob_get_clean();
                        });
                        $table->addCustomColumn('verwijderen', function ($row) use ($orderOverviewTranslations, $lang) {
                            ob_start(); ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/orders/delete">
                                <input type="hidden" name="order_id" value="<?= (int) $row['order_id'] ?>">
                                <button type="submit" class="btn btn-delete">
                                    <?= htmlspecialchars($orderOverviewTranslations[$lang]['delete']) ?>
                                </button>
                            </form>
                            <?php return ob_get_clean();
                        });
                        $table->addCustomColumn('details', function ($row) use ($orderOverviewTranslations, $lang) {
                            return '<a class="btn btn-view" href="' . BASE_URL . '/admin/orders/' . (int) $row['order_id'] . '">' . htmlspecialchars($orderOverviewTranslations[$lang]['view']) . '</a>';
                        });
                        $table->autoColumnLabels();
                        echo $table->renderTable();
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>
    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>

</html>
