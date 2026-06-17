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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/order-overview.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/order-filter.js" defer></script>
    <title>Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>
    <!--This code should be put on any page. The pages needs to have extension .php. Html files can't run php code.-->
    <?php include __DIR__ . '/../../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <?php if ($isDetail): ?>
                <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['order_details']) ?></h1>
                <a id="backlink" href="<?= BASE_URL ?>/orders">
                    <?= htmlspecialchars($orderOverviewTranslations[$lang]['back']) ?>
                </a>
                <?php
                    $table = new Table();
                    $table->setData($items);
                    $table->autoColumnLabels();
                    echo $table->renderTable();
                ?>
            <?php else: ?>
                <h1><?= htmlspecialchars($orderOverviewTranslations[$lang]['introduction']) ?></h1>

                <?php if (!empty($orders)): ?>
                    <?php $showSearch = false; include __DIR__ . '/../../components/order-filter.php'; ?>
                <?php endif; ?>

                <?php
                    $table = new Table();
                    $table->setData($orders);
                    $table->addCustomColumn('overview', function ($row) {
                        return '<a class="btn btn-view" href="' . BASE_URL . '/orders/' . (int) $row['order_id'] . '">Bekijk</a>';
                    });
                    $table->autoColumnLabels();
                    echo $table->renderTable();
                ?>
            <?php endif; ?>
        </section>
    </main>
    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
