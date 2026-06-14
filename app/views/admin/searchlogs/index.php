<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekslagen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/products.css">
    <script src="<?= BASE_URL ?>/assets/js/header.js" defer></script>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" />

    <!-- PLACEHOLDER STYLING -->
<style>
    /* table en button css uit order-overview.css */
   table {
    width: 100%;
    border-collapse: collapse;
    font-family: inherit;
}

thead {
    background-color: var(--color-header-footer-dark-blue);
    color: white;
}

th, td {
    padding: 10px 15px;
    text-align: center;
    border: 1px solid var(--color-main-light-gray);
}

tbody tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.03);
}

tbody tr:hover {
    background-color: var(--color-hover);
    color: white;
    transition: background-color 0.2s ease;
}

button {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: 0.2s ease;
}

button {
    background-color: var(--color-accent-orange);
    color: white;
}

button:hover {
    opacity: 0.85;
}
</style>

</head>

<body>
    <?php include __DIR__ . '/../../layouts/header.php' ?>

    <main>
        <h1>Zoekslagen</h1>

        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>string</th>
                    <th>timestamp</th>
                </tr>
            </thead>

            <tbody>
                Dit vullen met data uit `failed_search_logs`
                <tr>
                    <td>1</td>
                    <td>Kortezoekslag</td>
                    <td>2026-06-14</td>
                </tr>
                 <tr>
                    <td>2</td>
                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam amet, ducimus, cupiditate unde asperiores fuga sequi natus iure, repellendus dolorum eum? Eveniet pariatur cum, dicta voluptates itaque assumenda quidem facilis?</td>
                    <td>2026-06-14</td>
                </tr>
            </tbody>
        </table>

        <button>Delete</button>
        <button>Delete all</button>



        
    </main>

    <?php include __DIR__ . '/../../layouts/footer.php' ?>
</body>

</html>