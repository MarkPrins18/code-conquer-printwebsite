<?php
/** @var string $lang */
/** @var array $translations */
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($translations[$lang]['title']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/contact.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <main>
         <section class="header-row">
            <h1><?= translate('contact', $translations, $lang) ?></h1>
        </section>
        <div class="contact-grid">

            <aside class="contact-info">
                <div class="contact-info__block">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>
                        <strong><?= translate('address', $translations, $lang) ?></strong>
                        <span>Printstraat 3, 1234 AB Amsterdam</span>
                    </div>
                </div>
                <div class="contact-info__block">
                    <i class="fa-solid fa-envelope"></i>
                    <div>
                        <strong><?= translate('email', $translations, $lang) ?></strong>
                        <span>info@bouw3d.nl</span>
                    </div>
                </div>
                <div class="contact-info__block">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <strong><?= translate('phone', $translations, $lang) ?></strong>
                        <span>+31 20 123 4567</span>
                    </div>
                </div>
            </aside>

            <div class="contact-form-wrap">
                <?php if (!empty($success)): ?>
                    <p class="contact-alert contact-alert--success">
                        <i class="fa-solid fa-circle-check"></i> <?= translate('message_sent', $translations, $lang) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <p class="contact-alert contact-alert--error">
                        <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?>
                    </p>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/contact" method="POST" class="contact-form">
                    <div class="contact-form__field">
                        <label for="name"><?= translate('name', $translations, $lang) ?></label>
                        <input type="text" id="name" name="name" placeholder="<?= translate('placeholder_name', $translations, $lang) ?>" required
                               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" />
                    </div>
                    <div class="contact-form__field">
                        <label for="email"><?= translate('email', $translations, $lang) ?></label>
                        <input type="email" id="email" name="email" placeholder="<?= translate('placeholder_email', $translations, $lang) ?>" required
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
                    </div>
                    <div class="contact-form__field">
                        <label for="subject"><?= translate('subject', $translations, $lang) ?></label>
                        <input type="text" id="subject" name="subject" placeholder="<?= translate('placeholder_subject', $translations, $lang) ?>" required
                               value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" />
                    </div>
                    <div class="contact-form__field">
                        <label for="message"><?= translate('message', $translations, $lang) ?></label>
                        <textarea id="message" name="message" rows="5" placeholder="<?= translate('placeholder_message', $translations, $lang) ?>" required
                        ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="contact-form__btn">
                        Versturen <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <?php if (!empty($mailPreview)): ?>
    <script>
        alert(
            "Mail preview\n\n" +
            "Aan: <?= addslashes($mailPreview['aan']) ?>\n" +
            "Van: <?= addslashes($mailPreview['van']) ?>\n" +
            "Naam: <?= addslashes($_POST['name'] ?? '') ?>\n" +
            "Onderwerp: <?= addslashes($mailPreview['onderwerp']) ?>\n\n" +
            "<?= addslashes($mailPreview['bericht']) ?>"
        );
    </script>
    <?php endif; ?>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
