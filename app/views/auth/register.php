<?php
 /** @var array  $formHandlingTranslations */
 /** @var string $lang                     */
 /** @var array  $errors                   */
 /** @var array  $old                      */
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/register.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/password-toggle.css" />
    <script src="<?= BASE_URL ?>/assets/js/password-toggle.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title><?= htmlspecialchars(translate('title_register', $formHandlingTranslations, $lang)) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include __DIR__ . '/../layouts/header.php' ?>

    <main>
      <div class="register-card">

        <h1 class="accent-color">
          <?= htmlspecialchars(translate('title_register', $formHandlingTranslations, $lang)) ?>
        </h1>
        <p><?= htmlspecialchars(translate('sub_register_txt', $formHandlingTranslations, $lang)) ?></p>

        <form action="<?= BASE_URL ?>/register" method="POST">

          <!-- Bedrijfsnaam -->
          <div class="form-group">
            <input
              type="text"
              name="company_name"
              placeholder="<?= htmlspecialchars(translate('form_company', $formHandlingTranslations, $lang)) ?>"
              value="<?= htmlspecialchars($old['company_name'] ?? '') ?>"
              autocomplete="organization"
              <?= (!empty($errors['company_name']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
            >
            <?php if (!empty($errors['company_name'])): ?>
              <span class="error">
                <?= htmlspecialchars(translate($errors['company_name'], $formHandlingTranslations, $lang)) ?>
              </span>
            <?php endif ?>
          </div>

          <!-- E-mailadres -->
          <div class="form-group">
            <input
              type="email"
              name="email"
              placeholder="<?= htmlspecialchars(translate('form_email', $formHandlingTranslations, $lang)) ?>"
              value="<?= htmlspecialchars($old['email'] ?? '') ?>"
              autocomplete="email"
              <?= (!empty($errors['email']) || !empty($errors['email_exists']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
            >
            <?php if (!empty($errors['email'])): ?>
              <span class="error">
                <?= htmlspecialchars(translate($errors['email'], $formHandlingTranslations, $lang)) ?>
              </span>
            <?php elseif (!empty($errors['email_exists'])): ?>
              <span class="error">
                <?= htmlspecialchars(translate($errors['email_exists'], $formHandlingTranslations, $lang)) ?>
              </span>
            <?php endif ?>
          </div>

          <!-- Wachtwoord -->
          <div class="form-group password-wrapper">
            <input
              type="password"
              name="password"
              placeholder="<?= htmlspecialchars(translate('form_password', $formHandlingTranslations, $lang)) ?>"
              autocomplete="new-password"
              minlength="8"
              <?= (!empty($errors['password']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
            >
            <?php if (!empty($errors['password'])): ?>
              <span class="error">
                <?= htmlspecialchars(translate($errors['password'], $formHandlingTranslations, $lang)) ?>
              </span>
            <?php endif ?>
          </div>

          <!-- Wachtwoord bevestigen -->
          <div class="form-group password-wrapper">
            <input
              type="password"
              name="confirm"
              placeholder="<?= htmlspecialchars(translate('form_confirm', $formHandlingTranslations, $lang)) ?>"
              autocomplete="new-password"
              minlength="8"
              <?= (!empty($errors['confirm']) || !empty($errors['empty'])) ? 'class="invalid"' : '' ?>
            >
            <?php if (!empty($errors['confirm'])): ?>
              <span class="error">
                <?= htmlspecialchars(translate($errors['confirm'], $formHandlingTranslations, $lang)) ?>
              </span>
            <?php endif ?>
          </div>

          <!-- Algemeen lege-velden foutmelding -->
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

          <!-- Algemene voorwaarden -->
          <div class="terms-checkbox">
            <input
              type="checkbox"
              name="terms"
              id="terms"
              <?= !empty($errors['terms']) ? 'class="invalid"' : '' ?>
            >
            <label for="terms">
              <?= htmlspecialchars(translate('form_agree', $formHandlingTranslations, $lang)) ?>
              <a class="terms-link" href="#">
                <?= htmlspecialchars(translate('form_terms', $formHandlingTranslations, $lang)) ?>
              </a>
            </label>
          </div>
          <?php if (!empty($errors['terms'])): ?>
            <span class="error">
              <?= htmlspecialchars(translate($errors['terms'], $formHandlingTranslations, $lang)) ?>
            </span>
          <?php endif ?>

          <!-- Registreer-knop -->
          <div class="register-button-container">
            <button type="submit" name="submit" class="button button--large">
              <?= htmlspecialchars(translate('btn_register', $formHandlingTranslations, $lang)) ?>
            </button>
          </div>

        </form>

        <!-- Link naar inloggen -->
        <div class="login-link-container">
          <p>
            <?= htmlspecialchars(translate('link_login', $formHandlingTranslations, $lang)) ?>
            <a class="login-link" href="<?= BASE_URL ?>/login">
              <?= htmlspecialchars(translate('btn_login', $formHandlingTranslations, $lang)) ?>
            </a>
          </p>
        </div>

      </div>
    </main>

    <?php include __DIR__ . '/../layouts/footer.php' ?>
  </body>
</html>
