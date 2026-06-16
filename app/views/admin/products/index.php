<?php
/** @var array $products */
/** @var string $lang */
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin/products.css" />
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title>Admin – Producten</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>

<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <h1>Producten beheer</h1>
            <?php $successMsg = Session::getFlash('success'); ?>
            <?php if ($successMsg): ?>
            <p class="success"><?= htmlspecialchars($successMsg) ?></p>
            <?php endif; ?>
            <a class="button button--large product-create-btn" href="<?= BASE_URL ?>/admin/products/create">Maak product aan</a>
            <a class="button button--large" href="<?= BASE_URL ?>/admin/products/import">Importeer CSV</a>

            <?php if (empty($products)): ?>
            <p>Geen producten gevonden.</p>
            <?php else: ?>
            <?php
                $table = new Table();
                $table->setData($products);
                $table->setColumnRenderer('img_url', fn($val) => $val
                    ? '<img src="' . htmlspecialchars(BASE_URL . $val) . '" alt="product" style="height:48px;border-radius:4px;">'
                    : '—'
                );
                $table->autoColumnLabels();
                echo $table->renderTable();
                ?>
            <?php endif; ?>
        </section>
    </main>
    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>

</html>