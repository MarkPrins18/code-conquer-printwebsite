<?php
/** @var array $errors */
/** @var array $old */
/** @var string $lang */
/** @var array $translations */
?>
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
    <title><?= htmlspecialchars($translations[$lang]['titleCreate']) ?></title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>

<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>
    <main>
        <section class="introduction">
            <h1><?= htmlspecialchars($translations[$lang]['newProduct']) ?></h1>
            <a href="<?= BASE_URL ?>/admin/products"><?= htmlspecialchars($translations[$lang]['backOverview']) ?></a>

            <form class="create-form" method="POST" action="<?= BASE_URL ?>/admin/products" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name"><?= htmlspecialchars($translations[$lang]['name']) ?></label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" />
                    <?php if (!empty($errors['name'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['name']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="price"><?= htmlspecialchars($translations[$lang]['price']) ?></label>
                    <input type="number" id="price" name="price" step="0.01" min="0"
                        value="<?= htmlspecialchars($old['price'] ?? '') ?>" />
                    <?php if (!empty($errors['price'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['price']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description"><?= htmlspecialchars($translations[$lang]['description']) ?></label>
                    <textarea id="description"
                        name="description"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                    <?php if (!empty($errors['description'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['description']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="img_url"><?= htmlspecialchars($translations[$lang]['img_url']) ?></label>
                    <input type="file" id="img_url" name="img_url" accept="image/*" />
                    <?php if (!empty($errors['img_url'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['img_url']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="sku"><?= htmlspecialchars($translations[$lang]['sku']) ?></label>
                    <input type="text" id="sku" name="sku" value="<?= htmlspecialchars($old['sku'] ?? '') ?>" />
                    <?php if (!empty($errors['sku'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['sku']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="stock_quantity"><?= htmlspecialchars($translations[$lang]['stock_quantity']) ?></label>
                    <input type="number" id="stock_quantity" name="stock_quantity" min="0" step="1"
                        value="<?= htmlspecialchars($old['stock_quantity'] ?? '') ?>" />
                    <?php if (!empty($errors['stock_quantity'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['stock_quantity']) ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="button button--large"><?= htmlspecialchars($translations[$lang]['save']) ?></button>
            </form>
        </section>
    </main>
    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>

</html>