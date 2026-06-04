<?php

require_once __DIR__ . '/../includes/pdo.php';
require_once __DIR__. '/../classes/table-class.php';
require_once __DIR__ . '/../translations/translations.php';
require __DIR__ . '/../translations/header-footer-translations.php';

if (session_status() === PHP_SESSION_NONE) {
     session_start(); // Let op!!! dit moet binne de code van Sherwin gebeuren.
};

$allowedLanguages = ['nl', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'nl';

// Alleen voor development!
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 2;
}