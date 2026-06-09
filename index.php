<?php

// Defines the root folder of the project as a constant, so we can always build correct file paths from anywhere in the code
define('BASE_PATH', __DIR__);

// Registers an autoloader, instead of manually writing require_once for every class, PHP will automatically find and load the right file when a class is used for the first time
spl_autoload_register(function (string $class): void {
    $dirs = [
        BASE_PATH . '/app/core/',
        BASE_PATH . '/app/models/',
        BASE_PATH . '/app/controllers/',
        BASE_PATH . '/app/controllers/admin/',
    ];
    foreach ($dirs as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$allowedLanguages = ['nl', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'nl';


// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['user_id'] = 2;
// }


// Load all translation arrays so every controller and view can use them without loading them again
require_once BASE_PATH . '/app/lang/translations.php';
require_once BASE_PATH . '/app/lang/header-footer-translations.php';
require_once BASE_PATH . '/app/lang/order-overview-translations.php';
require_once BASE_PATH . '/app/lang/table-translations.php';
// require_once BASE_PATH . '/app/lang/formHandlingTranslations.php';


// Helper function used in every controller to load a view — automatically injects $lang and $headerFooterTranslations so the view always has access to them
function view(string $path, array $data = []): void {
    global $lang, $headerFooterTranslations;
    $data['lang']                     = $lang;
    $data['headerFooterTranslations'] = $headerFooterTranslations;
    extract($data);
    require BASE_PATH . '/app/views/' . $path . '.php';
}

// function view(string $path, array $data = []): void
// {
//     $lang = $_SESSION['lang'] ?? 'nl';

//     require BASE_PATH . '/app/lang/formHandlingTranslations.php';

//     $data['t'] = $formHandlingTranslations[$lang];

//     extract($data);

//     require BASE_PATH . '/app/views/' . $path . '.php';
// }


$baseDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$uri     = substr($_SERVER['REQUEST_URI'], strlen($baseDir)) ?: '/';


define('BASE_URL', $baseDir);

// Creates the router, loads all route definitions from config/routes.php, then matches the current URL to the right controller and method

$router = new Router();
require BASE_PATH . '/config/routes.php';
$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
