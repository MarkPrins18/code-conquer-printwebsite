<?php
session_start();

// Check of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login_form.php');
    exit;
}

// Haal login gegevens op
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Testgebruiker credentials
$correct_username = 'admin';
$correct_password = 'test123';

// Valideer login
if ($username === $correct_username && $password === $correct_password) {
    // Login succesvol
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['login_time'] = time();
    
    // Redirect naar admin pagina
    header('Location: admin.php');
    exit;
} else {
    // Login mislukt
    $_SESSION['error'] = 'Ongeldige gebruikersnaam of wachtwoord';
    header('Location: login_form.php');
    exit;
}
?>