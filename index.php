<?php 
require_once __DIR__. '\config\init.php';
require_once __DIR__. '\translations\index-translation.php';
?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/header.js" defer></script>
    <title>Bouw3D</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
  </head>

  <body>
    <!--This code should be put on any page. The pages needs to have extension .php. Html files can't run php code.-->
    <?php include 'layout/header.php' ?>

    <!--main added for semantic purposes-->
    <main>
      <section class="hero">
        <div class="hero-content">
          <h1><?= translate('heroH1', $translations, $lang) ?></h1>
          <h2 class="accent-color"><?= translate('heroH2', $translations, $lang) ?></h2>
          <a href="/about-us.php" class="button button--large"><?= translate('discover', $translations, $lang) ?></a>
        </div>
        <div class="hero-counter">
          <h2><?= translate('heroCounter', $translations, $lang) ?></h2>
          <div id="counters" class="fs-2">
            <span class="counter accent-color" data-target="50">0</span>
            <?= translate('heroTarget1', $translations, $lang) ?><br />
            <span class="counter accent-color" data-target="120">0</span>
            <?= translate('heroTarget2', $translations, $lang) ?><br />
            <span class="counter accent-color" data-target="25">0</span>
            <?= translate('heroTarget3', $translations, $lang) ?>
          </div>
        </div>
      </section>

      <section class="example p-1 m-1 text-center">
        <div class="upper-content">
          <h1 class="accent-color"><?= translate('exampleTitle', $translations, $lang) ?></h1>
          <p class="fs-2"><?= translate('exampleSubtitle', $translations, $lang) ?></p>
        </div>
        <!--Here is the list and content. No section required since they fall in the example section-->
        <div class="example-list">
          <!--div to set list and content next to eachother-->
          <ul class="select-example">
            <li class="list-item active-example" data-content="example-1"><?= translate('clientName1', $translations, $lang) ?></li>
            <li class="list-item" data-content="example-2"><?= translate('clientName2', $translations, $lang) ?></li>
            <li class="list-item" data-content="example-3"><?= translate('clientName3', $translations, $lang) ?></li>
            <li class="list-item" data-content="example-4"><?= translate('clientName4', $translations, $lang) ?></li>
            <li class="list-item" data-content="example-5"><?= translate('clientName5', $translations, $lang) ?></li>
          </ul>
          <div class="content fs-2">
            <article id="example-1" class="content-item">
              <blockquote>
                <?= translate('clientText1', $translations, $lang) ?>
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/Klant-1.png"
                  alt="<?= translate('clientAlt', $translations, $lang) ?>"
                />
                <figcaption><?= translate('clientName1', $translations, $lang) ?></figcaption>
              </figure>
            </article>
            <article id="example-2" class="content-item">
              <blockquote>
                <?= translate('clientText2', $translations, $lang) ?>
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-2.jpg"
                  alt="<?= translate('clientAlt', $translations, $lang) ?>"
                />
                <figcaption><?= translate('clientName2', $translations, $lang) ?></figcaption>
              </figure>
            </article>
            <article id="example-3" class="content-item">
              <blockquote>
                <?= translate('clientText3', $translations, $lang) ?>
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-3.png"
                  alt="<?= translate('clientAlt', $translations, $lang) ?>"
                />
                <figcaption><?= translate('clientName3', $translations, $lang) ?></figcaption>
              </figure>
            </article>
            <article id="example-4" class="content-item">
              <blockquote>
                <?= translate('clientText4', $translations, $lang) ?>
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-4.jpg"
                  alt="<?= translate('clientAlt', $translations, $lang) ?>"
                />
                <figcaption><?= translate('clientName4', $translations, $lang) ?></figcaption>
              </figure>
            </article>
            <article id="example-5" class="content-item">
              <blockquote>
                <?= translate('clientText5', $translations, $lang) ?>
              </blockquote>
              <figure>
                <img
                  src="assets/images/index-images/klant-5.jpg"
                  alt="<?= translate('clientAlt', $translations, $lang) ?>"
                />
                <figcaption><?= translate('clientName5', $translations, $lang) ?></figcaption>
              </figure>
            </article>
          </div>
        </div>
      </section>

      <section class="awards p-2">
        <h2 class="text-center"><?= translate('awardsTitle', $translations, $lang) ?></h2>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="<?= translate('altText1', $translations, $lang) ?>"
          />
          <div>
            <h3><?= translate('awardsSubTitle1', $translations, $lang) ?></h3>
            <p>
              <?= translate('awardsText1', $translations, $lang) ?>
            </p>
          </div>
        </article>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="<?= translate('altText2', $translations, $lang) ?>"
          />
          <div>
            <h3><?= translate('awardsSubTitle2', $translations, $lang) ?></h3>
            <p>
              <?= translate('awardsText2', $translations, $lang) ?>
            </p>
          </div>
        </article>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="<?= translate('altText3', $translations, $lang) ?>"
          />
          <div>
            <h3><?= translate('awardsSubTitle3', $translations, $lang) ?></h3>
            <p>
              <?= translate('awardsText3', $translations, $lang) ?>
            </p>
          </div>
        </article>

        <article class="award">
          <img
            src="assets/images/index-images/placeholder-image.webp"
            alt="<?= translate('altText4', $translations, $lang) ?>"
          />
          <div>
            <h3><?= translate('awardsSubTitle4', $translations, $lang) ?></h3>
            <p>
              <?= translate('awardsText4', $translations, $lang) ?>
            </p>
          </div>
        </article>
      </section>
    </main>
    <?php include 'layout/footer.php' ?>
  </body>
</html>
