<?php
session_start();
require_once __DIR__. '/config/init.php';
require_once __DIR__. '/translations/form-handling-translations.php';

/** @var array $formHandlingTranslations */
/** @var string $lang */

?>
<script>
console.log(<?php echo json_encode($_SESSION); ?>);
</script>

<?php if (isLoggedIn()) {
    redirectTo('orders.php');
}

$errors       = sessionGetAndClear('login_errors');
$old          = sessionGetAndClear('login_old', []);
$resetSuccess = sessionGetAndClear('reset_success', null);
$placeholder  = sessionGetAndClear('placeholder_reset_link', null);
sessionGetAndClear('placeholder_reset_email');
?>

<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?? 'nl' ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title><?= translate('title_login', $formHandlingTranslations, $lang) ?> – Bouw3D - Inloggen</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>

<?php include 'layout/header.php' ?>

<main class="auth-container">

    <?php if ($resetSuccess): ?>
        <div class="alert alert-success"><?= htmlspecialchars($resetSuccess) ?></div>
    <?php endif; ?>

    <?php if ($placeholder): ?>
        <div class="alert alert-info">
            <strong><?= t('msg_placeholder') ?>:</strong><br>
            <a href="<?= htmlspecialchars($placeholder) ?>"><?= htmlspecialchars($placeholder) ?></a>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="auth-form">
        <input type="hidden" name="action" value="login">

        <h1><?= t('title_login') ?></h1>

        <?php foreach ($errors as $error): ?>
            <p class="error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endforeach; ?>

        <div class="form-group">
            <label for="email"><?= t('form_email') ?></label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                   required placeholder="<?= t('form_email') ?>">
        </div>

        <div class="form-group">
            <label for="password"><?= t('form_password') ?></label>
            <input type="password" id="password" name="password"
                   required placeholder="<?= t('form_password') ?>">
            <a href="forgot-password.php" class="forgot-link"><?= t('link_forgot') ?></a>
        </div>

        <button type="submit" class="btn btn--primary"><?= t('btn_login') ?></button>
        <p class="form-footer"><a href="register.php"><?= t('link_register') ?></a></p>
    </form>

</main>

<footer><p><?= t('footer') ?></p></footer>
<script src="assets/js/auth.js"></script>
</body>
</html>


<!-- <html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title><?= translate('title_login', $translations, $lang) ?> – Bouw3D - Inloggen</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
  </head>

  <body>
    <?php include 'layout/header.php' ?> -->

  <main>
        <div class="login-card">
                <h1 class="accent-color"><?= translate('title_login', $formHandlingTranslations, $lang) ?></h1>
                <p>Voer uw gegevens in om in te loggen.</p>

                <form method="post" action="includes/auth-controller.php">

                    <div class="form-group">
                        <input type="email" name="email" placeholder="<?= translate('form_email', $formHandlingTranslations, $lang) ?>" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['email']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" name="password" placeholder="<?= translate('form_password', $formHandlingTranslations, $lang) ?>" required minlength="8">
                        <?php if (isset($errors['password'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['password']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-wrapper">
                        <label for="password"><?= translate('form_password', $formHandlingTranslations, $lang) ?></label>
                            <input type="password" id="password" name="password"
                        required placeholder="<?= translate('form_password', $formHandlingTranslations, $lang) ?>">
                            <a href="forgot-password.php" class="forgot-link"><?= translate('link_forgot', $formHandlingTranslations, $lang) ?></a>
                    </div>

                    <div class="login-button-container">
                        <button type="submit" class="button button--large" name = "submit"><?= translate('title_login', $formHandlingTranslations, $lang) ?></button>
                    </div>
                </form>
        
                <div class="register-link-container">
                    <p><?= translate('link_register', $formHandlingTranslations, $lang) ?><a class="login-link" href="register.php"><?= translate('btn_register', $formHandlingTranslations, $lang) ?></a></p>
                </div>
        </div>
    </main>
    <?php include 'layout/footer.php' ?>
  </body>
</html>