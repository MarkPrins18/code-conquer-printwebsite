<?php

class AuthGuard {
    public static function requireAdmin(): void {
        if (!Session::isLoggedIn() || !Session::isAdmin()) {
            header('Location: /');
            exit;
        }
    }

    public static function requireLogin(): void {
        if (!Session::isLoggedIn()) {
            header('Location: /register');
            exit;
        }
    }
}
