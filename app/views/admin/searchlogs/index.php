<?php
/** @var array $searchlogs */
/** @var array $translations */
/** @var string $lang */
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $translations[$lang]['title'] ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/products.css">
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />

</head>

<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <main>
        <h1><?= $translations[$lang]['title'] ?></h1>
        <?php

        if (empty($searchlogs)) { ?>
            <p><?= $translations[$lang]['noSearchLogsFound'] ?></p>
        <?php
        } else {
            $table = new Table();

            $table->setData($searchlogs);
            $table->addCustomColumn('Select', function ($row) {
                return '<input type="checkbox" name="selected_ids[]" value="' . $row['log_id'] . '">';
            });
            $table->autoColumnLabels();

            echo '<form method="POST" action=' . BASE_URL . '"/admin/searchlogs/delete">';
            echo $table->renderTable();
            echo '<br>' . '<button type="submit" class="button button--large" onclick="return confirm(\'Are you sure? This cannot be undone!\')">Delete</button>';
            echo '</form>';
        }
        ?>

    </main>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>

</html>