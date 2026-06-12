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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/register.css">
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= translate('title_register', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include  __DIR__ . '/../layouts/header.php' ?>

    <main>
        <div class="register-card">
            <h1 class="accent-color">
            <?= translate('title_register', $formHandlingTranslations, $lang) ?>
        </h1>
        <p><?= translate('sub_register_txt', $formHandlingTranslations, $lang) ?></p>

           <form action="<?= BASE_URL ?>/register" method="POST">

            <!-- Bedrijfsnaam -->
            <div class="form-group">
                <input
                    type="text"
                    name="company_name"
                    placeholder="<?= translate('form_company', $formHandlingTranslations, $lang) ?>"
                    value="<?= htmlspecialchars($old['company_name'] ?? '') ?>"
                    required
                    autocomplete="organization"
                >
            </div>

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
                    autocomplete="new-password"
                >
            </div>

            <!-- Wachtwoord bevestigen -->
            <div class="form-group password-wrapper">
                <input
                    type="password"
                    name="confirm"
                    placeholder="<?= translate('form_confirm', $formHandlingTranslations, $lang) ?>"
                    required
                    minlength="8"
                    autocomplete="new-password"
                >
            </div>

            <!-- Algemene Voorwaarden -->
            <div class="terms-checkbox">
                <input
                    type="checkbox"
                    name="terms"
                    id="terms"
                    required
                >
                <label for="terms">
                    <?= translate('form_agree', $formHandlingTranslations, $lang) ?>
                    <a class="terms-link" href="#">
                        <?= translate('form_terms', $formHandlingTranslations, $lang) ?>
                    </a>
                </label>
            </div>

            <!-- Registreer-knop -->
            <div class="register-button-container">
                <button type="submit" name="submit" class="button button--large">
                    <?= translate('btn_register', $formHandlingTranslations, $lang) ?>
                </button>
            </div>

        </form>

          <!-- Link naar inloggen -->
        <div class="login-link-container">
            <p>
                <?= translate('link_login', $formHandlingTranslations, $lang) ?>
                <a class="login-link" href="<?= BASE_URL ?>/login">
                    <?= translate('btn_login', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        </div>
    </main>

    <?php include __DIR__ . '/../layouts/footer.php' ?>
  </body>
</html>
