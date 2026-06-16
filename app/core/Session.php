<?php

class Session {
    public static function set(string $key, mixed $value): void {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed {
        return $_SESSION[$key] ?? $default;
    }

    public static function forget(string $key): void {
        unset($_SESSION[$key]);
    }

    public static function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin(): bool {
        return ($_SESSION['role_name'] ?? '') === 'Admin';
    }


    public static function destroy(): void {
        session_destroy();
    }

   
    
    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    

    public static function getFlash(string $key, mixed $default = null): mixed
    {   // we unset it immediately after showing, because these success or error messages are temporary
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }
}
