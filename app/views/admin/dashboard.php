<?php
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
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title>Admin – Dashboard</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>

<body>
    <?php include __DIR__ . '/../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <h1>

        </section>
    </main>
    <?php include __DIR__ . '/../layouts/footer.php' ?>
</body>

</html>