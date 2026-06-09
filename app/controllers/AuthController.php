<?php

class AuthController {
    public function showRegister(): void {
        view('auth/register'); 
    }

    public function handleRegister(): void {
        if (isset($_POST['submit'])) {
            $user = new User(
                $_POST['company_name'],
                $_POST['email'],
                $_POST['password'],
                $_POST['confirm']
            );
            $user->signupUser();
        }
    }

    public function handleLogin(): void {
        $user = new User(...);  //gebruiker Object
        $found = $user->loginUser($_POST['email'], $_POST['password']);
        if ($found) {
            Session::set('user_id', $found['user_id']);
            Session::set('role_name', $found['role_label']); // nodig voor isAdmin()
            header('Location: ' . BASE_URL . '/orders');
        } else {
            // terug naar het formulier met een foutmelding!
        }
    }
}
