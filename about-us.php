 <!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BOUW³D — Over ons</title>

  <!-- Centrale + pagina CSS (absoluut pad) -->
  <link rel="stylesheet" href="/code-conquer-printwebsite/assets/css/global.css" />
  <link rel="stylesheet" href="/code-conquer-printwebsite/assets/css/header-footer.css" />
  <link rel="stylesheet" href="/code-conquer-printwebsite/assets/css/components.css" />
  <link rel="stylesheet" href="/code-conquer-printwebsite/assets/css/about-us.css" />

  <!-- JS -->
  <script src="/code-conquer-printwebsite/assets/js/header.js" defer></script>
  <script src="/code-conquer-printwebsite/assets/js/about-us.js" defer></script>
</head>

<body>
  <?php include __DIR__ . '/layout/header.html'; ?>

  <main class="about-page">
    <div class="container">
      <section class="about-hero">
        <!-- LINKS: content -->
        <div class="hero-text">
          <h1>Over ons</h1>
          <p class="lead">
            BOUW³D is de 3D-printspecialist voor de bouw in Breda en omgeving.
            We versnellen projecten, verlagen kosten en beperken verspilling met
            hoogwaardige, op maat geprinte onderdelen.
          </p>

          <!-- KPI’s -->
          <div class="kpi-grid">
            <div class="kpi-card">
              <div class="kpi-value">5</div>
              <div class="kpi-label">Jaar actief</div>
            </div>
            <div class="kpi-card">
              <div class="kpi-value">420</div>
              <div class="kpi-label">Projecten geleverd</div>
            </div>
            <div class="kpi-card">
              <div class="kpi-value">4</div>
              <div class="kpi-label">Dagen doorlooptijd (gem.)</div>
            </div>
          </div>

          <!-- Pijlers -->
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

          <!-- Team (5) -->
          <section class="team">
            <h2>Het team</h2>
            <div class="team-grid">
              <div class="team-card">
                <div class="avatar">
                  <img src="/code-conquer-printwebsite/assets/images/team-leonel.jpg" alt="Leonel">
                </div>
                <div class="team-meta">
                  <strong>Leonel</strong>
                  <small>Projectlead</small>
                </div>
              </div>

              <div class="team-card">
                <div class="avatar">
                  <img src="/code-conquer-printwebsite/assets/images/team-sherwin.jpg" alt="Sherwin">
                </div>
                <div class="team-meta">
                  <strong>Sherwin</strong>
                  <small>Operations</small>
                </div>
              </div>

              <div class="team-card">
                <div class="avatar">
                  <img src="/code-conquer-printwebsite/assets/images/team-stefan.jpg" alt="Stefan">
                </div>
                <div class="team-meta">
                  <strong>Stefan</strong>
                  <small>Engineer</small>
                </div>
              </div>

              <div class="team-card">
                <div class="avatar">
                  <img src="/code-conquer-printwebsite/assets/images/team-mark.jpg" alt="Mark">
                </div>
                <div class="team-meta">
                  <strong>Mark</strong>
                  <small>Design</small>
                </div>
              </div>

              <div class="team-card">
                <div class="avatar">
                  <img src="/code-conquer-printwebsite/assets/images/team-david.jpg" alt="David">
                </div>
                <div class="team-meta">
                  <strong>David</strong>
                  <small>Quality</small>
                </div>
              </div>
            </div>
          </section>

          <!-- CTA -->
          <section class="cta">
            <div class="cta-inner">
              <h3>Klaar voor maatwerk?</h3>
              <p>Stuur je vraag en ontvang binnen 24 uur een voorstel.</p>
              <a class="btn btn--primary" href="/code-conquer-printwebsite/contact.php">Neem contact op</a>
            </div>
          </section>
        </div>

        <!-- RECHTS: sticky full-height foto -->
        <aside class="hero-media">
          <img
            src="/code-conquer-printwebsite/assets/images/index-images/3Dprinter-about-us.png"
            alt="Industriële 3D-printer in werkplaats"
            loading="lazy"
          >
        </aside>
      </section>
    </div>
  </main>

  <?php include __DIR__ . '/layout/footer.html'; ?>
</body>
</html>
