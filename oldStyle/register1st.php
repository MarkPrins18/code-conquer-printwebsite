<?php
require_once __DIR__. '/config/init.php';
require_once __DIR__ . '/translations/form-handling-translations.php';

// /** @var array  $formHandlingTranslations  geladen door init.php via translations.php */
// /** @var string $lang                      'nl' of 'en', gezet door init.php           */

$pdo = Database::getConnection();

if (session_status() === PHP_SESSION_NONE) { //start sessie als er geen sessie is.
     session_start(); 
};

// ----------------------------------------------------------
// 1. Al ingelogd? Stuur door naar orders-pagina
// ----------------------------------------------------------
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');

}

// ----------------------------------------------------------
// 2. Initialiseer fout- en invoervariabelen
// ----------------------------------------------------------
$errors = [];   // foutmeldingen voor de weergave
$old    = [];   // bewaard formulierinvoer (bij fout terugplaatsen)

// ----------------------------------------------------------
// 3. Verwerk POST-verzoek (gebruiker klikt op 'Registreren')
// ----------------------------------------------------------
if (isset($_POST['register'])) {

    // 3a. Haal POST-waarden op en trim witruimte
    $businessEmail = trim($_POST['business_email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Sla e-mail op zodat het veld na een fout gevuld blijft
    $old['business_email'] = $businessEmail;
?>


<script>
console.log(<?php echo json_encode($_SESSION); ?>);
</script>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'nl') ?>">
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
    <title><?= translate('title_register', $formHandlingTranslations, $lang) ?></title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
  </head>

  <body>
    <?php include 'layout/header.php' ?>

  <main>
        <div class="register-card">
                <h1 class="accent-color">
                    <?= translate('title_register', $formHandlingTranslations, $lang) ?></h1>
                <p><?= translate('sub_register', $formHandlingTranslations, $lang) ?></p>

                <form method="post" action="includes/auth-controller.php">
                    <div class="form-group">
                        <input type="text" name="company_name" 
                        placeholder="<?= translate('form_company_name', $formHandlingTranslations, $lang) ?>" 
                        value="<?= htmlspecialchars($old['company_name'] ?? '') ?>" required>

                        <?php if (isset($errors['company_name'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['company_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" 
                        placeholder="<?= translate('form_email', $formHandlingTranslations, $lang) ?>" 
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>

                        <?php if (isset($errors['email'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['email']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" name="password" 
                        placeholder="<?= translate('form_password', $formHandlingTranslations, $lang) ?>" 
                        required minlength="8">

                        <?php if (isset($errors['password'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['password']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" name="confirm" 
                        placeholder="<?= translate('form_confirm_password', $formHandlingTranslations, $lang) ?>" required>

                        <?php if (isset($errors['confirm'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['confirm']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" name="terms" 
                        id="terms" required>
                        <label for="terms"><?= translate('form_agree', $formHandlingTranslations, $lang) ?> 
                        <a class="terms-link" href="#"><?= translate('form_terms', $formHandlingTranslations, $lang) ?>
                        </a>
                        </label>
                        <?php if (isset($errors['terms'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['terms']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="register-button-container">
                        <button type="submit" class="button button--large" 
                        name = "submit"><?= translate('btn_register', $formHandlingTranslations, $lang) ?></button>
                    </div>
                </form>
        
                <div class="login-link-container">
                    <p><?= translate('link_login', $formHandlingTranslations, $lang) ?> 
                    <a class="login-link" href="login.php"><?= translate('btn_login', $formHandlingTranslations, $lang) ?>
                    </a>
                    </p>
                </div>
        </div>
    </main>
    <?php include 'layout/footer.php' ?>
  </body>
</html>