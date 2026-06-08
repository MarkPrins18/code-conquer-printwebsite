<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BOUW³D — Over ons</title>
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
          <h1>Over ons</h1>
          <p class="lead">
            BOUW³D brengt innovatieve 3D-printtechnologie naar de bouw in Breda en regio.
            <br> Met maatwerk oplossingen helpen wij bouwprojecten te versnellen, kosten te reduceren en materiaalverspilling te minimaliseren.
            Waar traditionele productie grenzen kent, bieden wij vrijheid: complexe vormen, unieke ontwerpen en last-minute aanpassingen realiseren wij zonder probleem.
            <br>Geen lange wachttijden of minimumorders – bij ons bestelt u precies wat u nodig heeft, wanneer u het nodig heeft.
            <br>Neem contact op voor een vrijblijvend gesprek over de mogelijkheden voor uw project.
          </p>

          <div class="kpi-grid">
            <div class="kpi-card">
              <div class="kpi-value">1</div>
              <div class="kpi-label">Jaar actief</div>
            </div>
            <div class="kpi-card">
              <div class="kpi-value">50</div>
              <div class="kpi-label">Projecten geleverd</div>
            </div>
            <div class="kpi-card">
              <div class="kpi-value">4</div>
              <div class="kpi-label">Dagen doorlooptijd (gem.)</div>
            </div>
          </div>

          <div class="pillar-grid">
            <article class="pillar-card">
              <h3>Onze Missie &amp; Innovatie</h3>
              <p>Versnellen en verspilling verminderen met slimme 3D-printoplossingen.</p>
            </article>
            <article class="pillar-card">
              <h3>Onze Visie &amp; Betrouwbaarheid</h3>
              <p>De 3D-printpartner voor de bouw. Betrouwbaarheid staat voorop.</p>
            </article>
            <article class="pillar-card">
              <h3>Waarden &amp; Duurzaamheid</h3>
              <p>Efficiënt materiaalgebruik en lokaal produceren met continue innovatie.</p>
            </article>
          </div>

          <section class="team">
            <h2>Het team</h2>
            <div class="team-grid">
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-leonel.jpg" alt="foto"></div>
                <div class="team-meta"><strong>Leonel</strong><small>Projectlead</small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-sherwin.jpg" alt="foto"></div>
                <div class="team-meta"><strong>Sherwin</strong><small>Operations</small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-stefan.jpg" alt="foto"></div>
                <div class="team-meta"><strong>Stefan</strong><small>Engineer</small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-mark.jpg" alt="foto"></div>
                <div class="team-meta"><strong>Mark</strong><small>Design</small></div>
              </div>
              <div class="team-card">
                <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/team-david.jpg" alt="foto"></div>
                <div class="team-meta"><strong>David</strong><small>Quality</small></div>
              </div>
            </div>
          </section>

          <section class="cta">
            <div class="cta-inner">
              <h3>Klaar voor maatwerk?</h3>
              <p>Stuur je vraag en ontvang binnen 24 uur een voorstel.</p>
              <a class="btn btn--primary" href="/contact">Neem contact op</a>
            </div>
          </section>
        </div>

        <aside class="hero-media">
          <img src="<?= BASE_URL ?>/assets/images/index-images/3Dprinter-about-us.png" alt="Industriële 3D-printer in werkplaats" loading="lazy">
        </aside>
      </section>
    </div>
  </main>

  <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>
</html>
