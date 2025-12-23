<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <script src="assets/js/header.js" defer></script>
    <script src="assets/js/products.js" defer></script>
    <link rel="stylesheet" href="assets/css/products.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
</head>

<body>
    <?php include 'layout/header.html' ?>

    <main>
        <section class="header-row">
            <h1>Producten</h1>
            <form id="search-container" role="search">
                <label for="search-input">Zoek producten:</label>
                <input type="text" id="search-input" placeholder="Typ hier je zoekterm..." />
                <button type="button" id="reset-search" aria-label="Reset zoekveld">&#10005;</button>
           </form>
        </section>

        <section class="products-container">
            <!--Products get dynamically added by JS-->
        </section>

        <section class="selfprint-cta-container">
            <h2>Wil je je eigen 3D-print laten maken?</h2>
            <p>Upload je ontwerp en wij zorgen dat het professioneel geprint wordt. Snel, makkelijk en betrouwbaar!</p>
            <button class="button button--large">Upload je ontwerp</button>
        </section>
    </main>

    <?php include 'layout/footer.html' ?>
</body>

</html>