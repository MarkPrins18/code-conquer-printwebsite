<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/header.css" />
    <script src="assets/js/index.js" defer></script>
    <title>Bouw3D</title>
    <!--add logo-->
    <link
      rel="icon"
      href="assets/images/index-images/icons8-favicon-32.png"
      type="image/png"
    />

    <!--<a target="_blank" href="https://icons8.com/icon/NyuxPErq0tu2/globe-africa">favicon</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>-->
  </head>

  <body>
    <header>
      <!--This code should be put on any page. The pages needs to have extension .php. Html files can't run php code.-->
      <?php include 'header.html' ?>
    </header>

    <!--main added for semantic  background and font are added here-->
    <main class="bg-light font-styling">
      <!--Hero section added for semantic-->
      <section class="hero">
        <div class="hero-content">
          <h1>Wij maken bouwen sneller met moderne</h1>
          <h2 class="accent-color">3d technieken.</h2>
          <!--animate with more words-->
          <a href="/about-us.php" class="btn">Ontdek meer</a>
          <!--Important! change link to correct HTML page-->
        </div>
        <div class="hero-counter">
          <h2>Onze impact in cijfers</h2>
          <div id="counters" class="fs-2">
            <span class="counter accent-color" data-target="50">0</span>
            projecten voltooid<br />
            <span class="counter accent-color" data-target="120">0</span>
            3D-modellen gemaakt<br />
            <span class="counter accent-color" data-target="25">0</span>
            tevreden klanten
          </div>
        </div>
      </section>

      <section class="example p-1 m-1 text-center">
        <div class="upper-content">
          <h1 class="accent-color">Voorbeelden van klanten</h1>
          <p class="fs-2">Hieronder zie je enkele voorbeelden</p>
        </div>
        <!--Here is the list and content. No section required since they fall in the example section-->
        <div class="example-list">
          <!--div to set list and content next to eachother-->
          <ul class="select-example">
            <li class="list-item" data-content="example-1">Delta Bouw</li>
            <li class="list-item" data-content="example-2">Studio Nova</li>
            <li class="list-item" data-content="example-3">Urban Build</li>
            <li class="list-item" data-content="example-4">Rossum Design</li>
            <li class="list-item" data-content="example-5">Willems en Zn</li>
          </ul>
          <div class="content fs-2">
            <article id="example-1" class="content-item">
              <blockquote>
                “De 3D-visualisaties van Bouw3D hebben ons enorm geholpen bij
                het overtuigen van onze opdrachtgever. Het ontwerp kwam tot
                leven nog vóór de eerste steen gelegd was.”
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/Klant-1.png"
                  alt="Klantfoto"
                />
                <figcaption>Delta Bouw</figcaption>
              </figure>
            </article>
            <article id="example-2" class="content-item">
              <blockquote>
                “Dankzij Bouw3D konden we ons bouwplan helder presenteren aan de
                gemeente. De visualisaties waren professioneel en tot in detail
                uitgewerkt.”
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-2.jpg"
                  alt="Klantfoto"
                />
                <figcaption>Studio Nova</figcaption>
              </figure>
            </article>
            <article id="example-3" class="content-item">
              <blockquote>
                “We hadden snel een 3D-model nodig voor een pitch, en Bouw3D
                leverde binnen 48 uur een prachtig resultaat. Ze denken mee en
                leveren kwaliteit.”
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-3.png"
                  alt="Klantfoto"
                />
                <figcaption>Urban Build</figcaption>
              </figure>
            </article>
            <article id="example-4" class="content-item">
              <blockquote>
                “Onze klanten waren onder de indruk van de realistische renders
                die Bouw3D maakte. Het gaf hen direct vertrouwen in het
                ontwerp.”
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-4.jpg"
                  alt="Klantfoto"
                />
                <figcaption>Rossum Design</figcaption>
              </figure>
            </article>
            <article id="example-5" class="content-item">
              <blockquote>
                “Door de visualisaties van Bouw3D ontdekten we een fout in de
                indeling nog vóór de bouw begon. Dat heeft ons veel tijd en
                kosten bespaard.”
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-5.jpg"
                  alt="Klantfoto"
                />
                <figcaption>Willems en Zn</figcaption>
              </figure>
            </article>
          </div>
        </div>
      </section>

      <section class="awards p-2">
        <h2 class="text-center">Waar wij trots op zijn</h2>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="Close-up van een 3D-printer die een bouwmodel print, met focus op precisie en techniek."
          />
          <div>
            <h3>Onze 3D-printers maken ideeën tastbaar</h3>
            <p>
              We zijn trots op onze moderne 3D-printers die bouwconcepten
              omzetten in fysieke modellen. Ze helpen klanten om hun plannen
              beter te begrijpen en sneller keuzes te maken. Deze technologie is
              een belangrijk onderdeel van onze missie om bouwen inzichtelijker
              te maken. Elke print is een stap richting slimmer bouwen.
            </p>
          </div>
        </article>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="Groepsfoto van de vijf oprichters van Bouw3D, lachend en samenwerkend in een creatieve werkruimte."
          />
          <div>
            <h3>Vijf oprichters, één gezamenlijke visie</h3>
            <p>
              Bouw3D is gestart door vijf jonge ondernemers met een passie voor
              techniek en innovatie. We combineren verschillende achtergronden
              en expertises om samen iets nieuws neer te zetten. Onze
              samenwerking is de motor achter alles wat we doen. We zijn trots
              op de energie, creativiteit en het vertrouwen dat we in elkaar
              hebben.
            </p>
          </div>
        </article>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="Een frisse blik op de bouwsector"
          />
          <div>
            <h3>Een frisse blik op de bouwsector</h3>
            <p>
              Als startup durven we anders te kijken naar hoe bouwprojecten
              worden voorbereid. We geloven in transparantie, snelheid en
              visuele communicatie. Onze aanpak is persoonlijk en flexibel,
              afgestemd op elke klant. We zijn trots op de eerste stappen die we
              zetten in een traditionele sector.
            </p>
          </div>
        </article>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="Handdruk tussen een Bouw3D teamlid en een klant, met een bouwproject op de achtergrond als symbool voor samenwerking."
          />
          <div>
            <h3>Groeien met onze klanten en partners</h3>
            <p>
              We staan nog aan het begin, maar we bouwen aan iets groots. Elke
              samenwerking is voor ons een kans om te leren en te verbeteren. We
              luisteren, denken mee en leveren met zorg en aandacht. We zijn
              trots op het vertrouwen dat we krijgen van de eerste klanten en
              partners.
            </p>
          </div>
        </article>
      </section>

      <!--placeholder for footer-->
      <div class="footer"></div>
    </main>
  </body>
</html>
