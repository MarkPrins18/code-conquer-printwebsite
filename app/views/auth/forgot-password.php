<?php
 /** @var array  $formHandlingTranslations */
 /** @var string $lang                     */
 /** @var array  $errors                   */
 /** @var array  $old                      */
 /** @var string $success                  */
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/forgot-password.css" />
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= translate('title_forgot', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include __DIR__ . '/../layouts/header.php' ?>

    <main>
      <div class="forgot-password-card">

        <h1 class="accent-color">
          <?= translate('title_forgot', $formHandlingTranslations, $lang) ?>
        </h1>

        <!-- Succesboodschap na versturen resetlink -->
        <?php if ($success !== ''): ?>
          <p class="contact-alert contact-alert--success">
            <i class="fa-solid fa-circle-check"></i>
            <?= translate($success, $formHandlingTranslations, $lang) ?>
          </p>
        <?php endif ?>

        <!-- Formulier verbergen als er al een succesboodschap is -->
        <?php if ($success === ''): ?>

          <form action="<?= BASE_URL ?>/forgot-password" method="POST">

            <!-- E-mailadres -->
            <div class="form-group">
              <input
                type="email"
                name="email"
                placeholder="<?= translate('form_email', $formHandlingTranslations, $lang) ?>"
                value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                autocomplete="email"
                <?= (!empty($errors['email']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
              >
              <?php if (!empty($errors['email'])): ?>
                <span class="error">
                  <?= translate($errors['email'], $formHandlingTranslations, $lang) ?>
                </span>
              <?php endif ?>
              <?php if (!empty($errors['empty'])): ?>
                <span class="error">
                  <?= translate($errors['empty'], $formHandlingTranslations, $lang) ?>
                </span>
              <?php endif ?>
              <?php if (!empty($errors['technical'])): ?>
                <span class="error">
                  <?= translate($errors['technical'], $formHandlingTranslations, $lang) ?>
                </span>
              <?php endif ?>
            </div>

            <!-- Verstuur-knop -->
            <div class="login-button-container">
              <button type="submit" name="submit" class="button button--large">
                <?= translate('btn_send', $formHandlingTranslations, $lang) ?>
              </button>
            </div>

          </form>

        <?php endif ?>

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
