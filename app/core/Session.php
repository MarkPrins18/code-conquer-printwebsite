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

   
    // ── Optie 1: flash() / getFlash() ────────────────────────────────────────
    //
    // Een flash-waarde leeft precies één redirect lang:
    //  Na POST.. Controller schrijft na POST  → Session::flash('errors', $errors)
    //  Na GET.. Controller leest + verwijdert na redirect → Session::getFlash('errors', [])
    //   Daarna is de waarde weg      → geen losse forget() nodig
    //
    // Alles zit onder $_SESSION['_flash'] zodat het nooit botst
    // met gewone sessievariabelen zoals 'user_id' of 'lang'.


    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * Lees een flash-waarde uit en verwijder hem meteen.
     * Geeft $default terug als de sleutel niet bestaat.
     *
     * Gebruik:
     *   $errors  = Session::getFlash('errors', []);
     *   $old     = Session::getFlash('old',    []);
     *   $success = Session::getFlash('success', '');
     */
    public static function getFlash(string $key, mixed $default = null): mixed
    {
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }
}
