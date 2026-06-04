<?php

//PHPDoc annotations for Intelephense.
/** @var array $headerFooterTranslations */
/** @var string $lang */

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin    = ($_SESSION['role_name'] ?? '') === 'Admin';
$isAdmin = true;

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
                <?php if ($isAdmin && $isLoggedIn): ?>
                <li><a href="admin/index.php">Dashboard</a></li>
                <li><a href="admin/orders/index.php">Bestellingen</a></li>
                <li><a href="admin/products/index.php">Producten</a></li>
                <?php else: ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Producten</a></li>
                <li><a href="services.php">Diensten</a></li>
                <li><a href="about-us.php">Over ons</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php endif; ?>

                <?php if (!$isLoggedIn): ?>
                <li>
                    <a href="register.php" class="button text button-small">Registreren</a>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Taal</button>
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
                            <?php if ($isAdmin && $isLoggedIn): ?>
                            <span class="admin-badge">Admin</span>
                            <?php endif; ?>
                        </button>
                        <div class="dropdown-content dropdown-content--right">
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-lang">
                                <span>Taal:</span>
                                <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'nl'])) ?>">NL</a>
                                <a href="?<?= http_build_query(array_merge($_GET, ['lang' => 'en'])) ?>">EN</a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="logout-link">Uitloggen</a>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>