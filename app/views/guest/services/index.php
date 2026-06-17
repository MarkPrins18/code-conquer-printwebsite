<?PHP
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/services.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css">
    <script src="<?= BASE_URL ?>/assets/js/services.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <main>
        <h1><?= htmlspecialchars($translations[$lang]['header']) ?></h1>

        <div class="layout-row">
            <section>
                <h2><?= htmlspecialchars($translations[$lang]['subHeader']) ?></h2>
                <p><?= htmlspecialchars($translations[$lang]['subText']) ?></p>
                <p><?= htmlspecialchars($translations[$lang]['portfolioIntro']) ?></p>
                <ul>
                    <li><?= htmlspecialchars($translations[$lang]['listItem1']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem2']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem3']) ?></li>
                </ul>
                <p><?= htmlspecialchars($translations[$lang]['materialsIntro']) ?></p>
                <p><?= htmlspecialchars($translations[$lang]['materialsText']) ?></p>
            </section>
            <div class="carousel-container">
                <img class="carousel-img" src="<?= BASE_URL ?>/assets/images/services-images/pexels-pixabay-159298.jpg" alt="<?= htmlspecialchars($translations[$lang]['altText']) ?>">
                <img class="carousel-img" src="<?= BASE_URL ?>/assets/images/services-images/Gemini_Generated_Image_9j1udi9j1udi9j1u.png" alt="<?= htmlspecialchars($translations[$lang]['altText']) ?>">
                <img class="carousel-img" src="<?= BASE_URL ?>/assets/images/services-images/Gemini_Generated_Image_rpz1btrpz1btrpz1.png" alt="<?= htmlspecialchars($translations[$lang]['altText']) ?>">
            </div>
        </div>

        <div class="layout-row">
            <img src="<?= BASE_URL ?>/assets/images/services-images/emotion-tech-HPEOsBTn8Ps-unsplash.jpg" alt="<?= htmlspecialchars($translations[$lang]['altText']) ?>">
            <section>
                <h2><?= htmlspecialchars($translations[$lang]['subHeader2']) ?></h2>
                <p><?= htmlspecialchars($translations[$lang]['subText2']) ?></p>
                <p><?= htmlspecialchars($translations[$lang]['portfolioIntro']) ?></p>
                <ul>
                    <li><?= htmlspecialchars($translations[$lang]['listItem4']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem5']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem6']) ?></li>
                </ul>
                <p><?= htmlspecialchars($translations[$lang]['materialsIntro']) ?></p>
                <p><?= htmlspecialchars($translations[$lang]['materialsText2']) ?></p>
            </section>
        </div>

        <div class="layout-row">
            <section>
                <h2><?= htmlspecialchars($translations[$lang]['designServiceHeader']) ?></h2>
                <p><?= htmlspecialchars($translations[$lang]['designServiceText1']) ?></p>
                <p><?= htmlspecialchars($translations[$lang]['designServiceText2']) ?></p>
                <ol>
                    <li><?= htmlspecialchars($translations[$lang]['listItem7']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem8']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem9']) ?></li>
                    <li><?= htmlspecialchars($translations[$lang]['listItem10']) ?></li>
                </ol>
                <p><?= htmlspecialchars($translations[$lang]['benefit']) ?></p>
                <p><?= htmlspecialchars($translations[$lang]['benefitText']) ?></p>
            </section>
            <img src="<?= BASE_URL ?>/assets/images/services-images/kumpan-electric-SYo5eazBrls-unsplash.jpg " alt="<?= htmlspecialchars($translations[$lang]['altText2']) ?>">                                                     
        </div>
    </main>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
