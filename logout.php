<?php
session_start();

// Vernietig alle sessie data
$_SESSION = array();

// Verwijder de sessie cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Vernietig de sessie
session_destroy();

// Redirect naar login pagina
header('Location: login_form.php');
exit;
?>