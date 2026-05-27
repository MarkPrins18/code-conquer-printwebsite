<?php
require_once __DIR__ . '/../translations/translations.php';
require_once __DIR__ . '/../translations/header-footer-translations.php';

session_start(); // Let op!!! dit moet binne de code van Sherwin gebeuren.

$allowedLanguages = ['nl', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'nl';