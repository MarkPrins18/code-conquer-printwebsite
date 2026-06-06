<?php
require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/translations/form-handling-translations.php';

 /** @var array  $formHandlingTranslations  geladen door init.php via translations.php */
 /** @var string $lang                      'nl' of 'en', gezet door init.php           */

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
// 3. Verwerk POST-verzoek (gebruiker klikt op 'Inloggen')
// ----------------------------------------------------------
if (isset($_POST['login'])) {

    // 3a. Haal POST-waarden op en trim witruimte
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    // Sla e-mail op zodat het veld na een fout gevuld blijft
    $old['email'] = $email;

    // ----------------------------------------------------------
    // VALIDATIE 1 – Verplichte velden
    // ----------------------------------------------------------
    if (empty($email) || empty($password)) {
        $errors[] = translate('err_required', $formHandlingTranslations, $lang);
    }

    // ----------------------------------------------------------
    // VALIDATIE 2 – E-mailformaat
    // ----------------------------------------------------------
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = translate('err_email', $formHandlingTranslations, $lang);
    }

    // ----------------------------------------------------------
    // VALIDATIE 3 – Minimale wachtwoordlengte (client-side guard)
    // ----------------------------------------------------------
    if (!empty($password) && strlen($password) < 8) {
        $errors[] = translate('err_password', $formHandlingTranslations, $lang);
    }

    // ----------------------------------------------------------
    // DATABASE-CHECK – alleen als frontend-validaties slagen
    // ----------------------------------------------------------
    if (empty($errors)) {

        echo "test";


        try {
            // PDO-verbinding via centrale Database-klasse (pdo.php)
            $pdo = Database::getConnection();

            // Haal gebruiker op via e-mailadres (uniek in DB)
            $sql  = "SELECT `user_id`, `email`, `password_hash`, `role_code`, `kvk`
                     FROM `users`
                     WHERE `email` = :email
                     LIMIT 1";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(); // PDO::FETCH_ASSOC is default in pdo.php


            echo '<pre>';
            var_dump($result);
            echo '</pre>';

            // ----------------------------------------------------------
            // VALIDATIE 4 – Gebruiker bestaat + wachtwoord klopt
            // password_verify() vergelijkt plain-text met bcrypt-hash
            // ----------------------------------------------------------
            if ($result && password_verify($password, $result['password_hash'])) {

                // Sessie opnieuw genereren om session-fixation te voorkomen
                session_regenerate_id(true);

                // Sessievariabelen vullen (zelfde patroon als prototype)
                $_SESSION['user_id']   = $result['user_id'];
                $_SESSION['email']     = $result['email'];
                $_SESSION['role_code'] = $result['role_code'];
                $_SESSION['kvk']       = $result['kvk'];

                // Doorsturen naar bestellingen-pagina na succesvol inloggen
                header('Location: index.php');
                

            } else {
                // Bewust vage foutmelding: geeft aanvaller geen info
                // of e-mail bestaat of wachtwoord fout is
                $errors[] = translate('err_login', $formHandlingTranslations, $lang);
                var_dump(password_verify($password, $result['password_hash']));
            }

        } catch (Exception $e) {
            // Technische DB-fout: log intern, toon veilige melding
            error_log('Login DB-fout: ' . $e->getMessage());
            $errors[] = translate('err_technical', $formHandlingTranslations, $lang);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'nl') ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title><?= translate('title_login', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>

<?php include 'layout/header.php' ?>

<main>

    <div class="login-card">

        <h1 class="accent-color">
            <?= translate('title_login', $formHandlingTranslations, $lang) ?>
        </h1>
        <p><?= translate('sub_login', $formHandlingTranslations, $lang) ?></p>

        <?php if (!empty($errors)): ?>
            <div class="error-block">
                <?php foreach ($errors as $error): ?>
                    <p class="error">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <?= htmlspecialchars($error) ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="login.php">

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
                <a href="forgot-password.php" class="forgot-link">
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
                <a class="login-link" href="register.php">
                    <?= translate('btn_register', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        </div>

    </div><!-- /.login-card -->

</main>

<?php include 'layout/footer.php' ?>
</body>
</html>