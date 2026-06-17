<?php
/** @var string $lang */
/** @var array $translations */
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($translations[$lang]['title']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/products.css">
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/products.js" defer></script>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <main>
        <section class="header-row">
            <h1><?= htmlspecialchars($translations[$lang]['products']) ?></h1>
            <form id="search-container" role="search">
                <label for="search-input"><?= htmlspecialchars($translations[$lang]['searchProducts']) ?></label>
                <input type="text" id="search-input" placeholder="<?= htmlspecialchars($translations[$lang]['searchPlaceholder']) ?>" />
                <button type="button" id="reset-search" aria-label="Reset zoekveld">&#10005;</button>
            </form>
        </section>

        <section class="products-container">
            <!--Products get dynamically added by JS-->
        </section>

        <section class="selfprint-cta-container">
            <h2><?= htmlspecialchars($translations[$lang]['selfprintCTA']) ?></h2>
            <p><?= htmlspecialchars($translations[$lang]['selfprintDescription']) ?></p>
            <button class="button button--large"><?= htmlspecialchars($translations[$lang]['selfprintButton']) ?></button>
        </section>
    </main>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
