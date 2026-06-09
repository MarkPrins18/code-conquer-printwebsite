<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BOUW3D</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="/assets/css/global.css" />
    <link rel="stylesheet" href="/assets/css/components.css" />
    <link rel="stylesheet" href="/assets/css/contact.css" />
    <link rel="stylesheet" href="/assets/css/header-footer.css" />
    <script src="/assets/js/contact.js" defer></script>
    <script src="/assets/js/header.js" defer></script>
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico" />
</head>
<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <section class="contact-hero">
        <div class="contact-hero__inner">
            <h1 class="contact-hero__title">Contact</h1>
            <p class="contact-hero__sub">Heb je een vraag of wil je een offerte? Stuur ons een bericht.</p>
        </div>
    </section>

    <main class="contact-main">
        <div class="contact-grid">

            <aside class="contact-info">
                <div class="contact-info__block">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>
                        <strong>Adres</strong>
                        <span>Printstraat 3, 1234 AB Amsterdam</span>
                    </div>
                </div>
                <div class="contact-info__block">
                    <i class="fa-solid fa-envelope"></i>
                    <div>
                        <strong>E-mail</strong>
                        <span>info@bouw3d.nl</span>
                    </div>
                </div>
                <div class="contact-info__block">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <strong>Telefoon</strong>
                        <span>+31 20 123 4567</span>
                    </div>
                </div>
            </aside>

            <div class="contact-form-wrap">
                <?php if (!empty($success)): ?>
                    <p class="contact-alert contact-alert--success">
                        <i class="fa-solid fa-circle-check"></i> Bericht verzonden! We nemen zo snel mogelijk contact op.
                    </p>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <p class="contact-alert contact-alert--error">
                        <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?>
                    </p>
                <?php endif; ?>

                <form action="/contact" method="POST" class="contact-form">
                    <div class="contact-form__field">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" placeholder="Jan de Vries" required
                               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" />
                    </div>
                    <div class="contact-form__field">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="jan@voorbeeld.nl" required
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
                    </div>
                    <div class="contact-form__field">
                        <label for="message">Bericht</label>
                        <textarea id="message" name="message" rows="5" placeholder="Schrijf hier je bericht..." required
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
            "Onderwerp: <?= addslashes($mailPreview['onderwerp']) ?>\n\n" +
            "<?= addslashes($mailPreview['bericht']) ?>"
        );
    </script>
    <?php endif; ?>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
