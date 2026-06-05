<?php
// =========================================================
// forgot-password.php  –  FR04-1  Wachtwoord vergeten
// Stappen:
//   1. Toon formulier (e-mailadres invoeren)
//   2. F/E validatie  – verplicht veld + e-mailformaat
//   3. B/E validatie  – gebruiker opzoeken in DB
//   4. Reset-token aanmaken en opslaan in DB
//   5. Placeholder mail-alert (geen echte e-mail in PoC)
//   6. Redirect naar login.php met succes-bericht in sessie
// =========================================================

require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/translations/form-handling-translations.php';

// /** @var array  $formHandlingTranslations */
// /** @var string $lang                     */

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
$errors          = [];    // foutmeldingen weergave
$old             = [];    // invoer bewaren bij fout
$placeholderLink = null;  // reset-link voor PoC-alert

// ----------------------------------------------------------
// POST-verwerking
// ----------------------------------------------------------
if (isset($_POST['submit'])) {

    $email    = trim($_POST['email'] ?? '');
    $old['email'] = $email;

    // ======================================================
    // F/E VALIDATIE 1 – Verplicht veld
    // ======================================================
    if (empty($email)) {
        $errors[] = translate('err_required', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // F/E VALIDATIE 2 – E-mailformaat
    // ======================================================
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = translate('err_email', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // B/E – Alleen uitvoeren als F/E-validaties slagen
    // ======================================================
    if (empty($errors)) {

        try {
            $pdo = Database::getConnection();

            // --------------------------------------------------
            // B/E VALIDATIE – Gebruiker ophalen uit DB
            // Bewust geen fout als e-mail NIET bestaat:
            // voorkomt e-mail-enumeratie (zelfde melding altijd)
            // --------------------------------------------------
            $sql  = "SELECT `user_id`, `email`
                     FROM `users`
                     WHERE `email` = :email
                     LIMIT 1";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result) {

                // ----------------------------------------------
                // TOKEN AANMAKEN
                // random_bytes(32) = 256-bit cryptografisch token
                // bin2hex = leesbare hex-string (64 tekens) voor de URL
                // password_hash = veilige opslag in DB (bcrypt)
                // ----------------------------------------------
                $plainToken = bin2hex(random_bytes(32));
                $tokenHash  = password_hash($plainToken, PASSWORD_DEFAULT);
                $expiresAt  = date('Y-m-d H:i:s', time() + 900); // 15 minuten geldig

                // Verwijder eerder aangevraagde tokens van deze gebruiker
                $delSql  = "DELETE FROM `password_reset_tokens`
                             WHERE `user_id` = :user_id";
                $delStmt = $pdo->prepare($delSql);
                $delStmt->bindParam(':user_id', $result['user_id'], PDO::PARAM_INT);
                $delStmt->execute();

                // Nieuw token opslaan in DB
                $insSql  = "INSERT INTO `password_reset_tokens`
                                (`user_id`, `token_hash`, `expires_at`)
                             VALUES
                                (:user_id, :token_hash, :expires_at)";
                $insStmt = $pdo->prepare($insSql);
                $insStmt->bindParam(':user_id',    $result['user_id'], PDO::PARAM_INT);
                $insStmt->bindParam(':token_hash', $tokenHash,       PDO::PARAM_STR);
                $insStmt->bindParam(':expires_at', $expiresAt,       PDO::PARAM_STR);
                $insStmt->execute();

                // ----------------------------------------------
                // PLACEHOLDER MAIL (PoC – geen echte e-mail)
                // In productie: stuur reset-link via SMTP/Mailer
                // ----------------------------------------------
                $resetLink = 'http://' . $_SERVER['HTTP_HOST']
                           . '/reset-password.php?token=' . urlencode($plainToken)
                           . '&email=' . urlencode($email);

                // Sla de placeholder-link op in sessie voor weergave
                $_SESSION['placeholder_reset_link']  = $resetLink;
                $_SESSION['placeholder_reset_email'] = $email;
            }

            // Altijd dezelfde succesmelding (ook als e-mail niet bestaat)
            $_SESSION['reset_email_sent'] = translate('msg_reset_sent', $formHandlingTranslations, $lang);

            header('Location: forgot-password.php');
            exit();

        } catch (Exception $e) {
            error_log('Forgot-password fout: ' . $e->getMessage());
            $errors[] = translate('err_technical', $formHandlingTranslations, $lang);
        }
    }
}

// ----------------------------------------------------------
// Haal eenmalige sessiewaarden op en wis ze direct
// ----------------------------------------------------------
$successMsg      = null;
$placeholderLink = null;

if (isset($_SESSION['reset_email_sent'])) {
    $successMsg = $_SESSION['reset_email_sent'];
    unset($_SESSION['reset_email_sent']);
}
if (isset($_SESSION['placeholder_reset_link'])) {
    $placeholderLink = $_SESSION['placeholder_reset_link'];
    unset($_SESSION['placeholder_reset_link']);
    unset($_SESSION['placeholder_reset_email']);
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
    <link rel="stylesheet" href="assets/css/forgot-password.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title><?= translate('title_forgot', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>

<?php include 'layout/header.php' ?>

<main>

    <div class="forgot-password-card">

        <h1 class="accent-color">
            <?= translate('title_forgot', $formHandlingTranslations, $lang) ?>
        </h1>
        <p><?= translate('msg_reset_sent', $formHandlingTranslations, $lang) ?></p>

        <!-- Succes-melding na POST-redirect -->
        <?php if ($successMsg): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <?= htmlspecialchars($successMsg) ?>
            </div>
        <?php endif; ?>

        <!-- PoC Placeholder: toon de reset-link direct op de pagina -->
        <?php if ($placeholderLink): ?>
            <div class="alert alert-info">
                <strong><?= translate('msg_placeholder', $formHandlingTranslations, $lang) ?>:</strong><br>
                <a href="<?= htmlspecialchars($placeholderLink) ?>">
                    <?= htmlspecialchars($placeholderLink) ?>
                </a>
            </div>
        <?php endif; ?>

        <!-- Foutmeldingen -->
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

        <!-- Formulier alleen tonen als er nog geen succes is -->
        <?php if (!$successMsg): ?>
        <form method="post" action="forgot-password.php">

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

            <!-- Verstuur-knop -->
            <div class="login-button-container">
                <button type="submit" name="submit" class="button button--large">
                    <?= translate('btn_send', $formHandlingTranslations, $lang) ?>
                </button>
            </div>

        </form>
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