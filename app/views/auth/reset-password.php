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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/reset-password.css">
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= translate('title_reset', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include  __DIR__ . '/../layouts/header.php' ?>

    <main>
        <div class="reset-password-card">
            <h1 class="accent-color">
            <?= translate('title_reset', $formHandlingTranslations, $lang) ?>
        </h1>
       

    
        
        <!-- Formulier alleen tonen als token geldig is -->

        <form action="<?= BASE_URL ?>/reset-password" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($tokenRow['token'] ?? $tokenRow['user_id'] ?? '') ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
        <!-- overige velden -->
    </form>

    <p><?= translate('err_token_due', $formHandlingTranslations, $lang) ?> <a href="<?= BASE_URL ?>/forgot-password"><?= translate('err_token_request', $formHandlingTranslations, $lang) ?></a>.</p>


    >

            <!-- Nieuw wachtwoord -->
            <div class="form-group password-wrapper">
                <input
                    type="password" name="password"
                    placeholder="<?= translate('form_password', $formHandlingTranslations, $lang) ?>"
                    required minlength="8"autocomplete="new-password"
                >
            </div>

            <!-- Wachtwoord bevestigen -->
            <div class="form-group password-wrapper">
                <input
                    type="password" name="confirm_password"
                    placeholder="<?= translate('form_confirm', $formHandlingTranslations, $lang) ?>"
                    required minlength="8" autocomplete="new-password"
                >
            </div>

            <!-- Opslaan-knop -->
            <div class="login-button-container">
                <button type="submit" name="submit" class="button button--large">
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
