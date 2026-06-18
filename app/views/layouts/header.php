<?php

$isLoggedIn = Session::isLoggedIn();
$isAdmin    = Session::isAdmin();

/** @var array  $headerFooterTranslations */
/** @var array  $formHandlingTranslations */
/** @var string $lang                     */
?>
<header>
    <nav>
        <div id="header-left">
            <a href="<?= BASE_URL ?>/">Bouw<sup>3</sup>D</a>
        </div>
        <button id="menu-toggle" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div id="header-right">
            <ul>
                <?php if ($isAdmin && $isLoggedIn): ?>
                <li><a href="<?= BASE_URL ?>/admin/orders"><?= translate('orders', $headerFooterTranslations, $lang) ?></a></li>
                <li><a href="<?= BASE_URL ?>/admin/products"><?= translate('products', $headerFooterTranslations, $lang) ?></a></li>
                <li><a href="<?= BASE_URL ?>/admin/searchlogs"><?= translate('searchLogs', $headerFooterTranslations, $lang) ?></a></li>                
                <?php else: ?>
                <li><a href="<?= BASE_URL ?>/"><?= translate('home', $headerFooterTranslations, $lang) ?></a></li>
                <li><a href="<?= BASE_URL ?>/products"><?= translate('products', $headerFooterTranslations, $lang) ?></a></li>
                <li><a href="<?= BASE_URL ?>/services"><?= translate('services', $headerFooterTranslations, $lang) ?></a></li>
                <li><a href="<?= BASE_URL ?>/about-us"><?= translate('about-us', $headerFooterTranslations, $lang) ?></a></li>
                <li><a href="<?= BASE_URL ?>/contact"><?= translate('contact', $headerFooterTranslations, $lang) ?></a></li>
                <?php endif; ?>

                <?php if (!$isLoggedIn): ?>
                <li>
                    <a href="<?= BASE_URL ?>/login" class="button text button-small">
                        <?= translate('title_login', $formHandlingTranslations, $lang) ?></a>
                    
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn"><?= translate('language', $headerFooterTranslations, $lang) ?></button>
                        <div class="dropdown-content">
                            <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'nl'])) ?>">NL</a>
                            <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'en'])) ?>">EN</a>
                        </div>
                    </div>
                </li>
                <?php else: ?>
                <li>
                    <div class="dropdown profile-dropdown">
                        <button class="dropbtn" aria-label="Profiel menu">
                            <?php if ($isAdmin): ?>
                            <span class="admin-badge">Admin</span>
                            <?php else: ?>
                            <i class="fa-solid fa-user"></i>
                            <?php endif; ?>
                        </button>
                        <div class="dropdown-content dropdown-content--right">
                            <a href="<?= BASE_URL ?>/orders"><?= translate('myOrders', $headerFooterTranslations, $lang) ?></a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-lang">
                                <span><?= translate('language', $headerFooterTranslations, $lang) ?>:</span>
                                <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'nl'])) ?>">NL</a>
                                <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'en'])) ?>">EN</a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="<?= BASE_URL ?>/logout" class="logout-link"><?= translate('logout', $headerFooterTranslations, $lang) ?></a>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>