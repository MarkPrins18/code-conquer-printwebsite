
/** @var array $t */

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'nl') ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css">
    <script src="<?= BASE_URL ?>/assets/js/index.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <!-- <title><?= $t['title_login'] ?> – Bouw3D</title> -->
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>

<?php include __DIR__ . '/app/views/layouts/header.php' ?>

<main>

    <div class="login-card">

        <h1 class="accent-color">
            <!-- <?= $t['title_login'] ?> -->
        </h1>
        <!-- <p><?= $t['sub_login'] ?></p> -->

        
        <form action="<?= BASE_URL ?>/login" method="POST">

            <!-- E-mailadres -->
            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    <!-- placeholder="<?= $t['form_email'] ?>" -->
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
                    <!-- placeholder="<?= $t['form_password'] ?>" -->
                    required
                    minlength="8"
                    autocomplete="current-password"
                >
                <a href="<?= BASE_URL ?>/forgot-password.php" class="forgot-link">
                    <!-- <?= $t['link_forgot'] ?> -->
                </a>
            </div>

            <!-- Inlog-knop -->
            <div class="login-button-container">
                <button type="submit" name="login" class="button button--large">
                    <!-- <?= $t['btn_login'] ?> -->
                </button>
            </div>

        </form>

        <!-- Link naar registratie -->
        <div class="register-link-container">
            <p>
               <!-- <?= $t['link_register'] ?> -->
                <a class="login-link" href="<?= BASE_URL ?>/register.php">
                    <!-- <?= $t['btn_register'] ?> -->
                </a>
            </p>
        </div>

    </div><!-- /.login-card -->

</main>

<?php include __DIR__ . '/app/views/layouts/footer.php' ?>
</body>
</html>