<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/register.css">
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <title>Bouw3D - Registreren</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <?php include __DIR__ . '/../layouts/header.php' ?>

    <main>
        <div class="register-card">
            <h1 class="accent-color">Account aanmaken</h1>
            <p>Creëer uw gratis account en start vandaag nog met het lokaal 3D-printen voor uw bouwprojecten.</p>

            <form method="post" action="/register">
                <div class="form-group">
                    <input type="text" name="company_name" placeholder="Bedrijfsnaam"
                           value="<?= htmlspecialchars($old['company_name'] ?? '') ?>" required>
                    <?php if (!empty($errors['company_name'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['company_name']) ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Zakelijk E-mailadres"
                           value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['email']) ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group password-wrapper">
                    <input type="password" name="password" placeholder="Wachtwoord" required minlength="8">
                    <?php if (!empty($errors['password'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['password']) ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group password-wrapper">
                    <input type="password" name="confirm" placeholder="Wachtwoord bevestigen" required>
                </div>

                <?php if (!empty($errors['empty'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['empty']) ?></span>
                <?php endif ?>

                <div class="terms-checkbox">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">Ik ga akkoord met de <a class="terms-link" href="#">Algemene Voorwaarden</a></label>
                </div>

                <div class="register-button-container">
                    <button type="submit" class="button button--large">Account aanmaken</button>
                </div>
            </form>

            <div class="login-link-container">
                <p>Heeft u al een account? <a class="login-link" href="/login">Log in</a></p>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../layouts/footer.php' ?>
  </body>
</html>
