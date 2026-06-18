<?php
/** @var string $lang */
/** @var array $translations */
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($translations[$lang]['title']) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/about-us.css" />
  <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
  <script src="<?= BASE_URL ?>/assets/js/about-us.js" defer></script>
  <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />
</head>
<body>
  <?php include __DIR__ . '/../../layouts/header.php' ?>

  <main class="about-page">
    <div class="container">
      <section class="about-hero">
        <div class="hero-text">
          <h1><?= htmlspecialchars($translations[$lang]['heading']) ?></h1>
          <p class="lead">
            <?= htmlspecialchars($translations[$lang]['intro1']) ?>
            <br> <?= htmlspecialchars($translations[$lang]['intro2']) ?>
            <?= htmlspecialchars($translations[$lang]['intro3']) ?>
            <br><?= htmlspecialchars($translations[$lang]['intro4']) ?>
            <br><?= htmlspecialchars($translations[$lang]['intro5']) ?>
          </p>

          <div class="kpi-grid">
            <div class="kpi-card">
              <div class="kpi-value">1</div>
              <div class="kpi-label"><?= htmlspecialchars($translations[$lang]['kpiYearsActive']) ?></div>
            </div>
            <div class="kpi-card">
              <div class="kpi-value">50</div>
              <div class="kpi-label"><?= htmlspecialchars($translations[$lang]['kpiProjectsDelivered']) ?></div>
            </div>
            <div class="kpi-card">
              <div class="kpi-value">4</div>
              <div class="kpi-label"><?= htmlspecialchars($translations[$lang]['kpiLeadTime']) ?></div>
            </div>
          </div>

          <div class="pillar-grid">
            <article class="pillar-card">
              <h3><?= htmlspecialchars($translations[$lang]['pillarMissionTitle']) ?></h3>
              <p><?= htmlspecialchars($translations[$lang]['pillarMissionText']) ?></p>
            </article>
            <article class="pillar-card">
              <h3><?= htmlspecialchars($translations[$lang]['pillarVisionTitle']) ?></h3>
              <p><?= htmlspecialchars($translations[$lang]['pillarVisionText']) ?></p>
            </article>
            <article class="pillar-card">
              <h3><?= htmlspecialchars($translations[$lang]['pillarValuesTitle']) ?></h3>
              <p><?= htmlspecialchars($translations[$lang]['pillarValuesText']) ?></p>
            </article>
          </div>

          <section class="team">
            <h2><?= htmlspecialchars($translations[$lang]['teamHeading']) ?></h2>
            <div class="team-grid">
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-leonel.jpg" alt="<?= htmlspecialchars($translations[$lang]['teamPhotoAlt']) ?>"></div>
                <div class="team-meta"><strong>Leonel</strong><small><?= htmlspecialchars($translations[$lang]['roleProjectLead']) ?></small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-sherwin.jpg" alt="<?= htmlspecialchars($translations[$lang]['teamPhotoAlt']) ?>"></div>
                <div class="team-meta"><strong>Sherwin</strong><small><?= htmlspecialchars($translations[$lang]['roleOperations']) ?></small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-stefan.jpg" alt="<?= htmlspecialchars($translations[$lang]['teamPhotoAlt']) ?>"></div>
                <div class="team-meta"><strong>Stefan</strong><small><?= htmlspecialchars($translations[$lang]['roleEngineer']) ?></small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-mark.jpg" alt="<?= htmlspecialchars($translations[$lang]['teamPhotoAlt']) ?>"></div>
                <div class="team-meta"><strong>Mark</strong><small><?= htmlspecialchars($translations[$lang]['roleDesign']) ?></small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-david.jpg" alt="<?= htmlspecialchars($translations[$lang]['teamPhotoAlt']) ?>"></div>
                <div class="team-meta"><strong>David</strong><small><?= htmlspecialchars($translations[$lang]['roleQuality']) ?></small></div>
              </div>
            </div>
          </section>

          <section class="cta">
            <div class="cta-inner">
              <h3><?= htmlspecialchars($translations[$lang]['ctaHeading']) ?></h3>
              <p><?= htmlspecialchars($translations[$lang]['ctaText']) ?></p>
              <a class="btn btn--primary" href="/contact"><?= htmlspecialchars($translations[$lang]['ctaButton']) ?></a>
            </div>
          </section>
        </div>

        <aside class="hero-media">
          <img src="<?= BASE_URL ?>/assets/images/index-images/3Dprinter-about-us.png" alt="<?= htmlspecialchars($translations[$lang]['heroImageAlt']) ?>" loading="lazy">
        </aside>
      </section>
    </div>
  </main>

  <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>