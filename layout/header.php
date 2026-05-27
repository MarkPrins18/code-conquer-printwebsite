<?php
//PHPDoc annotations for Intelephense.
/** @var array $headerFooterTranslations */
/** @var string $lang */
?>
<header>
  <nav>
    <div id="header-left">
      <a href="/">Bouw<sup>3</sup>D</a>
    </div>
    <button id="menu-toggle" aria-label="Open menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div id="header-right">
      <ul>
        <li><a href="index.php"><?= translate('home', $headerFooterTranslations, $lang) ?></a></li>
        <li><a href="products.php"><?= translate('products', $headerFooterTranslations, $lang) ?></a></li>
        <li><a href="services.php"><?= translate('services', $headerFooterTranslations, $lang) ?></a></li>
        <li><a href="about-us.php"><?= translate('about-us', $headerFooterTranslations, $lang) ?></a></li>
        <li><a href="contact.php"><?= translate('contact', $headerFooterTranslations, $lang) ?></a></li>
        <li>
            <a href="register.php" class="button text button-small">Registreren</a>
        </li>
        <li>
          <div class="dropdown">
            <button class="dropbtn">taal</button>
            <div class="dropdown-content">
              <!--<a href="?lang=nl">NL</a> This is the old way, it overides the other query parameters.
              <a href="?lang=en">EN</a> -->
              <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'nl'])) ?>">NL</a>
              <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'en'])) ?>">EN</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>