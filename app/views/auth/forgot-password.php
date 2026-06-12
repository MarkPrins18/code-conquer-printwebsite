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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/forgot-password.css">
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= translate('title_forgot', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include  __DIR__ . '/../layouts/header.php' ?>

    <main>
        <div class="forgot-password-card">
            <h1 class="accent-color">
            <?= translate('title_forgot', $formHandlingTranslations, $lang) ?>
        </h1>
        <p><?= translate('msg_reset_sent', $formHandlingTranslations, $lang) ?></p>

    
        
        <!-- Formulier alleen tonen als er nog geen succes is -->

        <form action="<?= BASE_URL ?>/forgot-password" method="POST">

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

            <!-- Verstuur-knop -->
            <div class="login-button-container">
                <button type="submit" name="submit" class="button button--large">
                    <a class="login-link" href="<?= BASE_URL ?>/reset-password"></a>
                    <?= translate('btn_send', $formHandlingTranslations, $lang) ?>
                </button>
            </div>

        </form>
        

        <!-- Terug naar inloggen -->
        <div class="register-link-container">
            <p>
                <a class="login-link" href="<?= BASE_URL ?>/login">
                    <?= translate('link_back', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        </div>

    </div>
    </main>

    <?php include __DIR__ . '/../layouts/footer.php' ?>
  </body>
</html>
