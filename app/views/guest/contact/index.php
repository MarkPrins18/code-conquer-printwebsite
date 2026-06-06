<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact - BOUW³D</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/contact.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <script src="<?= BASE_URL ?>/assets/js/contact.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <main>
        <?php if ($success ?? false): ?>
        <div class="alert alert--success">Uw bericht is verzonden. We nemen zo snel mogelijk contact op.</div>
        <?php endif ?>

        <div class="contact-header">
            <h1>Contact</h1>
            <div class="contact-buttons">
                <a href="https://wa.me/31763039244" class="contact-btn">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="mailto:Info@BOUW³D.nl" class="contact-btn">
                    <i class="fas fa-envelope"></i> Email
                </a>
                <a href="tel:+31763039244" class="contact-btn">
                    <i class="fas fa-phone"></i> Telefoon
                </a>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="left-column">
                <div class="contact-box">
                    <div class="contact-info">
                        <div class="contact-item">
                            <h3>WhatsApp</h3>
                            <p>+31 76 30 39 244</p>
                        </div>
                        <div class="contact-item">
                            <h3>Email</h3>
                            <p>Info@BOUW³D.nl</p>
                        </div>
                        <div class="contact-item">
                            <h3>Telefoon</h3>
                            <p>+31 76 30 39 244</p>
                        </div>
                    </div>

                    <div class="contact-form-container">
                        <h2>Contactformulier</h2>
                        <form class="contact-form" method="post" action="/contact">
                            <div class="form-group">
                                <input type="text" name="naam" placeholder="Naam" />
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="onderwerp" placeholder="Onderwerp" />
                            </div>
                            <div class="form-group">
                                <textarea name="bericht" placeholder="Bericht" rows="5"></textarea>
                            </div>
                            <button type="submit" class="submit-btn">Verzenden</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="right-column">
                <div class="info-section">
                    <div class="service-info">
                        <h2>Onze klantenservice staat voor je klaar</h2>
                        <p>Neem gemakkelijk contact op via een van onze contactopties en wij helpen je graag met al je vragen. De openingstijden van onze klantenservice zijn:</p>
                        <p class="opening-hours"><strong>Maandag t/m Vrijdag: 08:00 – 17:00</strong></p>
                    </div>
                    <div class="company-info">
                        <h2>Bedrijfsgegevens</h2>
                        <p><strong>BOUW³D</strong></p>
                        <p><strong>Adres:</strong> Konijnenberg 286A, Breda, 4852DG</p>
                        <p><strong>KVK:</strong> 101902025</p>
                        <p><strong>IBAN:</strong> NL10INGB0000002025</p>
                        <p><strong>BTW:</strong> NL001002025B20</p>
                    </div>
                    <div class="follow-us">
                        <h2>FOLLOW US</h2>
                        <p>Volg BOUW³D op social media</p>
                        <div class="social-icons">
                            <a href="https://www.facebook.com/BOUW3D" class="social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/BOUW3D" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/company/BOUW3D" class="social-link" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
