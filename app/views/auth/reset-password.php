<?php
 /** @var array  $formHandlingTranslations */
 /** @var string $lang                     */
 /** @var array  $errors                   */
 /** @var string $token                    */
 /** @var string $email                    */
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/reset-password.css" />
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= translate('title_reset', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include __DIR__ . '/../layouts/header.php' ?>

    <main>
      <div class="reset-password-card">

        <h1 class="accent-color">
          <?= translate('title_reset', $formHandlingTranslations, $lang) ?>
        </h1>

        <?php if (!empty($errors['token'])): ?>

          <!-- Ongeldig of verlopen token — toon alleen foutmelding + link -->
          <p class="contact-alert contact-alert--error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?= translate($errors['token'], $formHandlingTranslations, $lang) ?>
          </p>
          <div class="register-link-container">
            <p>
              <a class="login-link" href="<?= BASE_URL ?>/forgot-password">
                <?= translate('err_token_request', $formHandlingTranslations, $lang) ?>
              </a>
            </p>
          </div>

        <?php else: ?>

          <!-- Technische fout -->
          <?php if (!empty($errors['technical'])): ?>
            <p class="contact-alert contact-alert--error">
              <i class="fa-solid fa-circle-exclamation"></i>
              <?= translate($errors['technical'], $formHandlingTranslations, $lang) ?>
            </p>
          <?php endif ?>

          <form action="<?= BASE_URL ?>/reset-password" method="POST">

            <!-- Token en e-mail als verborgen velden meesturen met POST -->
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

            <!-- Nieuw wachtwoord -->
            <div class="form-group password-wrapper">
              <input
                type="password"
                name="password"
                placeholder="<?= translate('form_password', $formHandlingTranslations, $lang) ?>"
                autocomplete="new-password"
                minlength="8"
                <?= (!empty($errors['password']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
              >
              <?php if (!empty($errors['password'])): ?>
                <span class="error">
                  <?= translate($errors['password'], $formHandlingTranslations, $lang) ?>
                </span>
              <?php endif ?>
            </div>

            <!-- Wachtwoord bevestigen -->
            <div class="form-group password-wrapper">
              <input
                type="password"
                name="confirm_password"
                placeholder="<?= translate('form_confirm', $formHandlingTranslations, $lang) ?>"
                autocomplete="new-password"
                minlength="8"
                <?= (!empty($errors['confirm']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
              >
              <?php if (!empty($errors['confirm'])): ?>
                <span class="error">
                  <?= translate($errors['confirm'], $formHandlingTranslations, $lang) ?>
                </span>
              <?php endif ?>
            </div>

            <!-- Lege velden fout -->
            <?php if (!empty($errors['empty'])): ?>
              <span class="error">
                <?= translate($errors['empty'], $formHandlingTranslations, $lang) ?>
              </span>
            <?php endif ?>

            <!-- Opslaan-knop -->
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
