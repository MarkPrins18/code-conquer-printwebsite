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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/password-toggle.css" />
    <script src="<?= BASE_URL ?>/assets/js/password-toggle.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= htmlspecialchars(translate('title_login', $formHandlingTranslations, $lang)) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include __DIR__ . '/../layouts/header.php' ?>

    <main>
      <div class="login-card">

        <h1 class="accent-color">
          <?= htmlspecialchars(translate('title_login', $formHandlingTranslations, $lang)) ?>
        </h1>
        <p><?= htmlspecialchars(translate('sub_login', $formHandlingTranslations, $lang)) ?></p>

        <!-- Succesboodschap na wachtwoord-reset -->
        <?php if ($success !== ''): ?>
          <p class="contact-alert contact-alert--success">
            <i class="fa-solid fa-circle-check"></i>
            <?= htmlspecialchars(translate($success, $formHandlingTranslations, $lang)) ?>
          </p>
        <?php endif ?>

        <form action="<?= BASE_URL ?>/login" method="POST">

          <!-- E-mailadres -->
          <div class="form-group">
            <input
              type="email"
              name="email"
              placeholder="<?= htmlspecialchars(translate('form_email', $formHandlingTranslations, $lang)) ?>"
              value="<?= htmlspecialchars($old['email'] ?? '') ?>"
              autocomplete="email"
              <?= (!empty($errors['email']) || !empty($errors['credentials']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
            >
            <?php if (!empty($errors['email'])): ?>
              <span class="error">
                <?= htmlspecialchars(translate($errors['email'], $formHandlingTranslations, $lang)) ?>
              </span>
            <?php endif ?>
          </div>

          <!-- Wachtwoord -->
          <div class="form-group password-wrapper">
            <input
              type="password"
              name="password"
              placeholder="<?= htmlspecialchars(translate('form_password', $formHandlingTranslations, $lang)) ?>"
              autocomplete="current-password"
              minlength="8"
              <?= (!empty($errors['credentials']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
            >
            <a href="<?= BASE_URL ?>/forgot-password" class="forgot-link">
              <?= htmlspecialchars(translate('link_forgot', $formHandlingTranslations, $lang)) ?>
            </a>
          </div>

          <!-- Gecombineerde e-mail/wachtwoord fout — bewust vaag -->
          <?php if (!empty($errors['credentials'])): ?>
            <span class="error">
              <?= htmlspecialchars(translate($errors['credentials'], $formHandlingTranslations, $lang)) ?>
            </span>
          <?php endif ?>

          <!-- Lege velden fout -->
          <?php if (!empty($errors['empty'])): ?>
            <span class="error">
              <?= htmlspecialchars(translate($errors['empty'], $formHandlingTranslations, $lang)) ?>
            </span>
          <?php endif ?>

          <!-- Technische fout -->
          <?php if (!empty($errors['technical'])): ?>
            <span class="error">
              <?= htmlspecialchars(translate($errors['technical'], $formHandlingTranslations, $lang)) ?>
            </span>
          <?php endif ?>

          <!-- Login-knop -->
          <div class="login-button-container">
            <button type="submit" name="login" class="button button--large">
              <?= htmlspecialchars(translate('btn_login', $formHandlingTranslations, $lang)) ?>
            </button>
          </div>

        </form>

        <!-- Link naar registreren -->
        <div class="register-link-container">
          <p>
            <?= htmlspecialchars(translate('link_register', $formHandlingTranslations, $lang)) ?>
            <a class="login-link" href="<?= BASE_URL ?>/register">
              <?= htmlspecialchars(translate('btn_register', $formHandlingTranslations, $lang)) ?>
            </a>
          </p>
        </div>

      </div>
    </main>

    <?php include __DIR__ . '/../layouts/footer.php' ?>
  </body>
</html>
