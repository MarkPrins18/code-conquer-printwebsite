<?php
session_start();
require_once __DIR__. '/config/init.php';
?>
<script>
console.log(<?php echo json_encode($_SESSION); ?>);
</script>
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
    <?php include 'layout/header.php' ?>

  <main>
        <div class="register-card">
                <h1 class="accent-color">Account aanmaken</h1>
                <p>Creëer uw gratis account en start vandaag nog met het lokaal 3D-printen voor uw bouwprojecten.</p>

                <form method="post" action="includes/User-inc.php">
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
                        <label for="terms">Ik ga akkoord met de <a class="terms-link" href="#">Algemene Voorwaarden</span></label>
                        <?php if (isset($errors['terms'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['terms']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="register-button-container">
                        <button type="submit" class="button button--large" name = "submit">Account aanmaken</button>
                    </div>
                </form>
        
                <div class="login-link-container">
                    <p>Heeft u al een account? <a class="login-link" href="login.php">Log in</a></p>
                </div>
        </div>
    </main>
    <?php include 'layout/footer.php' ?>
  </body>
</html>
