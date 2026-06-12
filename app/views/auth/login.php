<?php



 /** @var array  $formHandlingTranslations */
 /** @var string $lang                     */
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'nl') ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css">
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= translate('title_login', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>

<?php include __DIR__ . '/../layouts/header.php' ?>

<main>

    <div class="login-card">

        <h1 class="accent-color">
            <?= translate('title_login', $formHandlingTranslations, $lang) ?>
        </h1>

        <p>
            <?= translate('sub_login', $formHandlingTranslations, $lang) ?>
        </p>

        <form action="<?= BASE_URL ?>/login" method="POST">

            <!-- E-mailadres -->
            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="<?= translate('form_email', $formHandlingTranslations, $lang) ?>"
                    value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    required
                    autocomplete="email"
                >
            </div>

            <!-- Wachtwoord -->
            <div class="form-group password-wrapper">
                <input
                    type="password"
                    name="password"
                    placeholder="<?= translate('form_password', $formHandlingTranslations, $lang) ?>"
                    required
                    minlength="8"
                    autocomplete="current-password"
                >

                <!-- Forgot-password-knop -->
                <a href="<?= BASE_URL ?>/forgot-password" class="forgot-link">
                    <?= translate('link_forgot', $formHandlingTranslations, $lang) ?>
                </a>
            </div>

            <!-- Inlog-knop -->
            <div class="login-button-container">
                <button type="submit" name="login" class="button button--large">
                    <?= translate('btn_login', $formHandlingTranslations, $lang) ?>
                </button>
            </div>

        </form>

        <!-- Link naar registratie -->
        <div class="register-link-container">
            <p>
               <?= translate('link_register', $formHandlingTranslations, $lang) ?>
                <a class="login-link" href="<?= BASE_URL ?>/register">
                    <?= translate('btn_register', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        </div>

    </div>

</main>

<?php include __DIR__ . '/../layouts/footer.php' ?>
</body>
</html>