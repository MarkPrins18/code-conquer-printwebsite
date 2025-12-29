<?php
session_start();

require_once 'src/models/Role.php';
require_once 'src/models/User.php';

$errors = [];
$old = [];
$successMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'company_name' => trim($_POST['company_name'] ?? ''),
        'email'        => strtolower(trim($_POST['email'] ?? '')),
        'password'     => $_POST['password'] ?? '',
        'confirm'      => $_POST['confirm'] ?? '',
        'terms'        => !empty($_POST['terms']),
    ];

    $old = [
        'company_name' => $data['company_name'],
        'email'        => $data['email']
    ];

    if (empty($data['terms'])) {
        $errors['terms'] = 'U moet akkoord gaan met de algemene voorwaarden';
    }

    $newUser = null;
    if (empty($errors)) {
        $newUser = User::create(
            $data['email'],
            $data['password'],
            $data['confirm'],
            $data['company_name'],
        );

        if (!$newUser && isset($_SESSION['form_errors'])) {
            $errors = array_merge($errors, $_SESSION['form_errors']);
        }
    }

    if ($newUser) {
        $role = $newUser->getRole();
        $roleName = $role ? $role->getName() : 'customer';
        
        $successMessage = "Account succesvol aangemaakt!\n\n";
        $successMessage .= "E-mail: " . htmlspecialchars($newUser->getEmail()) . "\n";
        $successMessage .= "Rol: " . ucfirst($roleName) . "\n";
        $successMessage .= "Aangemaakt op: " . $newUser->getCreatedAt();

        $old = [];
        unset($_SESSION['form_errors'], $_SESSION['old_input']);
    } else {
        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old_input'] = $old;
        }
    }
} else {
    if (isset($_SESSION['form_errors'])) {
        $errors = $_SESSION['form_errors'];
        unset($_SESSION['form_errors']);
    }
    if (isset($_SESSION['old_input'])) {
        $old = $_SESSION['old_input'];
        unset($_SESSION['old_input']);
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
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
    <title>Bouw3D - Registreren</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>
<body>
    <?php include 'layout/header.html' ?>

    <main>
        <div class="register-card">
            <h1 class="accent-color">Account aanmaken</h1>
            <p>Creëer uw gratis account en start vandaag nog met het lokaal 3D-printen voor uw bouwprojecten.</p>

            <?php if ($successMessage): ?>
                <div class="success">
                    <pre><?= $successMessage ?></pre>
                </div>
            <?php else: ?>
                <form method="post" action="" novalidate>
                    <div class="form-group">
                        <input type="text" name="company_name" placeholder="Bedrijfsnaam" value="<?= htmlspecialchars($old['company_name'] ?? '') ?>" required>
                        <?php if (isset($errors['company_name'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['company_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Zakelijk E-mailadres" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['email']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" name="password" placeholder="Wachtwoord" required minlength="8">
                        <?php if (isset($errors['password'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['password']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" name="confirm" placeholder="Wachtwoord bevestigen" required>
                        <?php if (isset($errors['confirm'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['confirm']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">Ik ga akkoord met de <a class="terms-link" href="#">Algemene Voorwaarden</a></label>
                        <?php if (isset($errors['terms'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['terms']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="register-button-container">
                        <button type="submit" class="button button--large">Account aanmaken</button>
                    </div>
                </form>

                <div class="login-link-container">
                    <p>Heeft u al een account? <a class="login-link" href="login.php">Log in</a></p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'layout/footer.html' ?>
</body>
</html>