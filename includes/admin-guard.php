<?php

if (!isset($_SESSION['user_id']) || ($_SESSION['role_name'] ?? '') !== 'Admin') {
    header('Location: /index.php');
    exit;
}
