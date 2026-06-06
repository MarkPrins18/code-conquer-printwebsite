<?php
// Stappen:
//   1. Al ingelogd? Redirect naar index.php
//   2. Initialiseer $errors en $old
//   3. POST-verwerking bij submit
//        F/E VALIDATIE 1 – Verplichte velden
//        F/E VALIDATIE 2 – Bedrijfsnaam (tekens)
//        F/E VALIDATIE 3 – E-mailformaat
//        F/E VALIDATIE 4 – Wachtwoord (min 8, hoofdletter, cijfer)
//        F/E VALIDATIE 5 – Wachtwoorden komen overeen
//        F/E VALIDATIE 6 – Algemene Voorwaarden aangevinkt
//        B/E VALIDATIE 1 – Bedrijfsnaam bestaat in companies-tabel → haal kvk op
//        B/E VALIDATIE 2 – E-mail nog niet geregistreerd in users-tabel
//        INSERT          – Nieuwe user aanmaken in users-tabel
//        SESSION         – Sessie vullen + session_regenerate_id()
//        REDIRECT        – Na succes naar index.php
// ======

require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/translations/form-handling-translations.php';

/** @var array  $formHandlingTranslations */
/** @var string $lang                     */

// ------------
// 1. Al ingelogd? Geen reden om hier te zijn
// ----------
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// --------------
// 2. Initialiseer fout- en invoervariabelen
// -------------
$errors = [];   // foutmeldingen voor de weergave
$old    = [];   // bewaard formulierinvoer (bij fout terugplaatsen)

// ---------------
// 3. POST-verwerking (gebruiker klikt op 'Account aanmaken')
// ---------------
if (isset($_POST['submit'])) {

    // Haal POST-waarden op en trim witruimte
    $company_name = trim($_POST['company_name'] ?? '');
    $email        = trim($_POST['email']        ?? '');
    $password     =      $_POST['password']     ?? '';  // GEEN trim – spaties in wachtwoord zijn geldig
    $confirm      =      $_POST['confirm']      ?? '';
    $terms        = isset($_POST['terms']);              // checkbox: true of false

    // Bewaar invoer voor terugplaatsen bij fout (nooit wachtwoord terugplaatsen)
    $old['company_name'] = $company_name;
    $old['email']        = $email;

    // =========
    // F/E VALIDATIE 1 – Verplichte velden
    // ===========
    if (empty($company_name) || empty($email) || empty($password) || empty($confirm)) {
        $errors[] = translate('err_required', $formHandlingTranslations, $lang);
    }

    // ============
    // F/E VALIDATIE 2 – Bedrijfsnaam: letters, cijfers, spaties en &-tekens toegestaan
    // Ruimer dan het prototype (alleen a-z0-9) zodat namen als
    // "Code & Conquer BV" of "Willems en Zn." wel werken
    // ================
    if (!empty($company_name) && !preg_match('/^[a-zA-Z0-9\s\&\.\-]+$/', $company_name)) {
        $errors[] = translate('err_company', $formHandlingTranslations, $lang);
    }

    // =============
    // F/E VALIDATIE 3 – E-mailformaat
    // =============
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = translate('err_email', $formHandlingTranslations, $lang);
    }

    // =============
    // F/E VALIDATIE 4 – Wachtwoord: min 8 tekens + hoofdletter + cijfer
    // Zelfde regex als reset-password.php voor consistentie
    // ======================================================
    if (!empty($password) && !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $errors[] = translate('err_password', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // F/E VALIDATIE 5 – Wachtwoorden komen overeen
    // ======================================================
    if (!empty($password) && !empty($confirm) && $password !== $confirm) {
        $errors[] = translate('err_confirm', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // F/E VALIDATIE 6 – Algemene Voorwaarden aangevinkt
    // ======================================================
    if (!$terms) {
        $errors[] = translate('err_terms', $formHandlingTranslations, $lang);
    }

    // ======================================================
    // B/E – Alleen uitvoeren als alle F/E-validaties slagen
    // ======================================================
    if (empty($errors)) {

        try {
            $pdo = Database::getConnection();

            // --------------------------------------------------
            // B/E VALIDATIE 1 – Bedrijfsnaam opzoeken in companies
            // De users-tabel vereist een geldige kvk (FK).
            // Alleen bedrijven die al in de DB staan mogen registreren.
            // --------------------------------------------------
            $sqlCompany = "SELECT `kvk`
                           FROM `companies`
                           WHERE `name` = :name
                           LIMIT 1";

            $stmtCompany = $pdo->prepare($sqlCompany);
            $stmtCompany->bindParam(':name', $company_name, PDO::PARAM_STR);
            $stmtCompany->execute();
            $company = $stmtCompany->fetch(); // PDO::FETCH_ASSOC is default (pdo.php)

            if (!$company) {
                // Bedrijfsnaam niet gevonden in de companies-tabel
                $errors[] = translate('err_company', $formHandlingTranslations, $lang);
            }

            // --------------------------------------------------
            // B/E VALIDATIE 2 – E-mail mag nog niet bestaan in users
            // (users.email is UNIQUE in de DDL)
            // --------------------------------------------------
            if (empty($errors)) {

                $sqlEmail = "SELECT `user_id`
                             FROM `users`
                             WHERE `email` = :email
                             LIMIT 1";

                $stmtEmail = $pdo->prepare($sqlEmail);
                $stmtEmail->bindParam(':email', $email, PDO::PARAM_STR);
                $stmtEmail->execute();
                $bestaandeUser = $stmtEmail->fetch();

                if ($bestaandeUser) {
                    // E-mail is al geregistreerd
                    $errors[] = translate('err_email_exists', $formHandlingTranslations, $lang);
                }
            }

            // --------------------------------------------------
            // INSERT – Alle validaties geslaagd: gebruiker aanmaken
            // --------------------------------------------------
            if (empty($errors)) {

                // Wachtwoord hashen met bcrypt (PASSWORD_DEFAULT = bcrypt)
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Nieuwe user invoegen — role_code 'USER' is de standaard rol
                $sqlInsert = "INSERT INTO `users`
                                  (`kvk`, `role_code`, `email`, `password_hash`)
                              VALUES
                                  (:kvk, 'USER', :email, :password_hash)";

                $stmtInsert = $pdo->prepare($sqlInsert);
                $stmtInsert->bindParam(':kvk',           $company['kvk'], PDO::PARAM_STR);
                $stmtInsert->bindParam(':email',         $email,          PDO::PARAM_STR);
                $stmtInsert->bindParam(':password_hash', $passwordHash,   PDO::PARAM_STR);
                $stmtInsert->execute();

                // Haal het nieuwe user_id op van de zojuist ingevoegde rij
                $newUserId = (int) $pdo->lastInsertId();

                // --------------------------------------------------
                // SESSION – Sessie opbouwen na succesvolle registratie
                // session_regenerate_id() voorkomt session-fixation
                // Zelfde patroon als login.php
                // --------------------------------------------------
                session_regenerate_id(true);

                $_SESSION['user_id']   = $newUserId;
                $_SESSION['email']     = $email;
                $_SESSION['role_code'] = 'USER';
                $_SESSION['kvk']       = $company['kvk'];

                // Redirect naar index (ingelogd na registratie)
                header('Location: index.php');
                exit();
            }

        } catch (Exception $e) {
            // Technische DB-fout: log intern, toon veilige melding aan gebruiker
            error_log('Register DB-fout: ' . $e->getMessage());
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
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title><?= translate('title_register', $formHandlingTranslations, $lang) ?> – Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>

<?php include 'layout/header.php' ?>

<main>

    <div class="register-card">

        <h1 class="accent-color">
            <?= translate('title_register', $formHandlingTranslations, $lang) ?>
        </h1>
        <p><?= translate('sub_register_txt', $formHandlingTranslations, $lang) ?></p>

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

        <form method="post" action="register.php">

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
                <a class="login-link" href="login.php">
                    <?= translate('btn_login', $formHandlingTranslations, $lang) ?>
                </a>
            </p>
        </div>

    </div><!-- /.register-card -->

</main>

<?php include 'layout/footer.php' ?>
</body>
</html>