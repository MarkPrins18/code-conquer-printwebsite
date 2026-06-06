<?php
$isLoggedIn = Session::isLoggedIn();
$isAdmin    = Session::isAdmin();
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
                <li><a href="/admin/orders">Bestellingen</a></li>
                <li><a href="/admin/products">Producten</a></li>
                <?php else: ?>
                <li><a href="<?= BASE_PATH ?>/">Home</a></li>
                <li><a href="<?= BASE_PATH ?>/products">Producten</a></li>
                <li><a href="<?= BASE_PATH ?>/services">Diensten</a></li>
                <li><a href="<?= BASE_PATH ?>/about-us">Over ons</a></li>
                <li><a href="<?= BASE_PATH ?>/contact">Contact</a></li>
                <?php endif; ?>

                <?php if (!$isLoggedIn): ?>
                <li>
<<<<<<< HEAD:layout/header.php
                    <a href="login.php" class="button text button-small">Inloggen</a>
=======
                    <a href="/register" class="button text button-small">Registreren</a>
>>>>>>> main:app/views/layouts/header.php
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
                            <?php if ($isAdmin): ?>
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
                            <a href="/logout" class="logout-link">Uitloggen</a>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
