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
}
