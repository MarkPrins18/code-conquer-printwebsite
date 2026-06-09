<?php
// =========================================================
// reset-password.php  –  FR04-2  Nieuw wachtwoord instellen
// Stappen:
//   1. Token + e-mail uit URL valideren (GET)
//   2. Token opzoeken in DB + verloopdatum controleren
//   3. Toon formulier voor nieuw wachtwoord
//   4. F/E validatie  – verplicht, min 8 tekens, bevestiging
//   5. B/E validatie  – token nogmaals verifiëren bij POST
//   6. Wachtwoord hashen + updaten in DB (users)
//   7. Token verwijderen uit DB (password_reset_tokens)
//   8. Redirect naar login.php met succes-bericht in sessie
// =========================================================

require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/translations/form-handling-translations.php';

 /** @var array  $formHandlingTranslations */
 /** @var string $lang                     */

$pdo = Database::getConnection();

if (session_status() === PHP_SESSION_NONE) { //start sessie als er geen sessie is.
     session_start(); 
};

// ----------------------------------------------------------
// Al ingelogd? Geen reden om hier te zijn
// ----------------------------------------------------------
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// ----------------------------------------------------------
// Initialiseer variabelen
// ----------------------------------------------------------
$errors     = [];
$tokenValid = false;   // wordt true als token bestaat en niet verlopen is
$tokenRow   = null;    // volledige rij uit password_reset_tokens
$email      = '';
$plainToken = '';

// ----------------------------------------------------------
// STAP 1 – Token en e-mail ophalen uit de URL (GET)
// ----------------------------------------------------------
$plainToken = trim($_GET['token'] ?? '');
$email      = trim($_GET['email'] ?? '');

// F/E check: zijn token en e-mail überhaupt aanwezig in de URL?
if (empty($plainToken) || empty($email)) {
    $errors[] = translate('err_token', $formHandlingTranslations, $lang);
}

// ----------------------------------------------------------
// STAP 2 – Token valideren in DB (alleen als URL-params aanwezig)
// ----------------------------------------------------------
if (empty($errors)) {

    try {
        $pdo = Database::getConnection();

        // Zoek token op via de bijbehorende user (e-mail → user_id → token)
        $sql  = "SELECT prt.`token_id`, prt.`token_hash`, prt.`expires_at`, u.`user_id`
                 FROM `password_reset_tokens` prt
                 INNER JOIN `users` u ON u.`user_id` = prt.`user_id`
                 WHERE u.`email` = :email
                 LIMIT 1";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $tokenRow = $stmt->fetch();

        // B/E VALIDATIE – Token bestaat + hash klopt + niet verlopen
        if (
            $tokenRow &&
            password_verify($plainToken, $tokenRow['token_hash']) &&
            strtotime($tokenRow['expires_at']) > time()
        ) {
            $tokenValid = true;
        } else {
            // Token niet gevonden, hash klopt niet, of verlopen
            $errors[] = translate('err_token', $formHandlingTranslations, $lang);
        }

    } catch (Exception $e) {
        error_log('Reset-password token-check fout: ' . $e->getMessage());
        $errors[] = translate('err_technical', $formHandlingTranslations, $lang);
    }
}

// ----------------------------------------------------------
// STAP 3 – POST-verwerking: nieuw wachtwoord opslaan
// ----------------------------------------------------------
if ($tokenValid && isset($_POST['submit'])) {

    $newPassword     = $_POST['password']         ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // ======================================================
    // F/E VALIDATIE 1 – Verplichte velden
    // ======================================================
    if (empty($newPassword) || empty($confirmPassword)) {
        $errors[] = translate('err_required', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // F/E VALIDATIE 2 – Minimaal 8 tekens + hoofdletter + cijfer
    // ======================================================
    if (!empty($newPassword) && !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword)) {
        $errors[] = translate('err_password', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // F/E VALIDATIE 3 – Wachtwoorden komen overeen
    // ======================================================
    if (!empty($newPassword) && !empty($confirmPassword) && $newPassword !== $confirmPassword) {
        $errors[] = translate('err_confirm', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // B/E – Token nogmaals verifiëren + wachtwoord updaten
    // ======================================================
    if (empty($errors)) {

        try {
            // B/E VALIDATIE – Token opnieuw ophalen (race-condition beveiliging)
            $checkSql  = "SELECT prt.`token_id`, prt.`token_hash`, prt.`expires_at`, u.`user_id`
                          FROM `password_reset_tokens` prt
                          INNER JOIN `users` u ON u.`user_id` = prt.`user_id`
                          WHERE u.`email` = :email
                          LIMIT 1";

            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $checkStmt->execute();
            $freshRow = $checkStmt->fetch();

            if (
                $freshRow &&
                password_verify($plainToken, $freshRow['token_hash']) &&
                strtotime($freshRow['expires_at']) > time()
            ) {
                // Nieuw wachtwoord hashen
                $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

                // Wachtwoord updaten in users-tabel
                $updSql  = "UPDATE `users`
                             SET `password_hash` = :password_hash
                             WHERE `user_id` = :user_id";
                $updStmt = $pdo->prepare($updSql);
                $updStmt->bindParam(':password_hash', $newHash,               PDO::PARAM_STR);
                $updStmt->bindParam(':user_id',       $freshRow['user_id'],   PDO::PARAM_INT);
                $updStmt->execute();

                // Token verwijderen zodat het niet opnieuw gebruikt kan worden
                $delSql  = "DELETE FROM `password_reset_tokens`
                             WHERE `token_id` = :token_id";
                $delStmt = $pdo->prepare($delSql);
                $delStmt->bindParam(':token_id', $freshRow['token_id'], PDO::PARAM_INT);
                $delStmt->execute();

                // Succes-bericht in sessie + redirect naar login
                $_SESSION['reset_success'] = translate('msg_reset_success', $formHandlingTranslations, $lang);
                header('Location: login.php');
                exit();

            } else {
                // Token verlopen of al gebruikt tussen eerste check en POST
                $errors[] = translate('err_token', $formHandlingTranslations, $lang);
                $tokenValid = false;
            }

        } catch (Exception $e) {
            error_log('Reset-password update fout: ' . $e->getMessage());
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
    <link rel="stylesheet" href="assets/css/reset-password.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title><?= translate('title_reset', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>

<?php include 'layout/header.php' ?>

<main>

    <div class="reset-password-card">

        <h1 class="accent-color">
            <?= translate('title_reset', $formHandlingTranslations, $lang) ?>
        </h1>

        <!-- Foutmeldingen (ook verlopen token) -->
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

        <!-- Formulier alleen tonen als token geldig is -->
        <?php if ($tokenValid): ?>
        <form method="post" action="reset-password.php?token=<?= urlencode($plainToken) ?>&email=<?= urlencode($email) ?>">

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
        <?php else: ?>
            <!-- Token ongeldig of verlopen: stuur naar forgot-password -->
            <p>
                <a class="login-link" href="forgot-password.php">
                    <?= translate('title_forgot', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        <?php endif; ?>

        <!-- Terug naar inloggen -->
        <div class="register-link-container">
            <p>
                <a class="login-link" href="login.php">
                    <?= translate('link_back', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        </div>

    </div><!-- /.login-card -->

</main>

<?php include 'layout/footer.php' ?>
</body>
</html>