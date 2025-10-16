<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <script src="assets/js/header.js" defer></script>
    <script src="assets/js/products.js" defer></script>
    <link rel="stylesheet" href="assets/css/products.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>

<body>
    <?php include 'header.html' ?>

    <div class="main-container">
        <div class="header-row">
            <h1>Producten</h1>
            <div id="searchContainer">
                <span id="resetSearch">&#10005;</span>
                <input type="text" id="searchInput" placeholder="Zoek producten..." />
            </div>
        </div>
        <div class="products-container">
            <!--Products get dynamically added by JS-->
        </div>

        <div class="selfprint-cta-container">
            <h3>Wil je je eigen 3D-print laten maken?</h3>
            <p>Upload je ontwerp en wij zorgen dat het professioneel geprint wordt. Snel, makkelijk en betrouwbaar!</p>
            <button class="button button--large">Upload je ontwerp</button>
        </div>
    </div>

</body>

</html>