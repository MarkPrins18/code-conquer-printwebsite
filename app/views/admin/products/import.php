<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin/create.css" />
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title>Admin – CSV importeren</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>

<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <h1>Producten importeren via CSV</h1>
            <a href="<?= BASE_URL ?>/admin/products">← Terug naar overzicht</a>

            <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php if (isset($saved)): ?>
                <?php if ($saved > 0): ?>
                    <p class="success"><?= $saved ?> product(en) succesvol opgeslagen.</p>
                <?php endif; ?>
                <?php if (!empty($rowErrors)): ?>
                    <p class="error">De volgende rijen konden niet worden verwerkt:</p>
                    <ul>
                        <?php foreach ($rowErrors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if ($saved === 0 && empty($rowErrors)): ?>
                    <p>Het CSV bestand bevatte geen rijen.</p>
                <?php endif; ?>
            <?php endif; ?>

            <form class="create-form" method="POST" action="<?= BASE_URL ?>/admin/products/import" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="csv_file">CSV bestand</label>
                    <input type="file" id="csv_file" name="csv_file" accept=".csv" />
                    <small>Alleen .csv bestanden, maximaal 10 MB. Kolommen: <code>name, price, description, img_url, sku, stock_quantity</code></small>
                </div>
                <button type="submit" class="button button--large">Opslaan</button>
            </form>
        </section>
    </main>
    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>

</html>
