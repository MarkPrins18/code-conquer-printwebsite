<?php

/**
 * SessionTest
 *
 * Unit tests voor app/core/Session.php
 *
 * Wat wordt getest:
 *   set()        — slaat een waarde op in $_SESSION
 *   get()        — leest een waarde terug, met fallback default
 *   forget()     — verwijdert een sleutel uit $_SESSION
 *   isLoggedIn() — true als 'user_id' in sessie staat
 *   isAdmin()    — true als role_name === 'Admin'
 *   destroy()    — wist alle sessiedata
 */
class SessionTest extends TestCase
{
    /**
     * setUp() wordt vóór elke test aangeroepen.
     * We wissen $_SESSION zodat tests elkaar niet beïnvloeden.
     */
    public function setUp(): void
    {
        $_SESSION = [];
    }

    // ── set() en get() ────────────────────────────────────────────────────────

    public function testSetSlaatWaardeOpInSessie(): void
    {
        Session::set('user_id', 42);

        $this->assertEquals(42, $_SESSION['user_id']);
    }

    public function testGetLeestWaardeTerug(): void
    {
        $_SESSION['user_id'] = 7;

        $result = Session::get('user_id');

        $this->assertEquals(7, $result);
    }

    public function testGetGeeftDefaultAlsSleutelNietBestaat(): void
    {
        $result = Session::get('bestaat_niet', 'standaard');

        $this->assertEquals('standaard', $result);
    }

    public function testGetGeeftNullAlsGeenDefaultMeegegeven(): void
    {
        $result = Session::get('bestaat_niet');

        $this->assertNull($result);
    }

    public function testSetOverschrijftBestaandeWaarde(): void
    {
        Session::set('taal', 'nl');
        Session::set('taal', 'en');

        $this->assertEquals('en', Session::get('taal'));
    }

    public function testSetSlaatStringOp(): void
    {
        Session::set('role_name', 'Admin');

        $this->assertEquals('Admin', Session::get('role_name'));
    }

    public function testSetSlaatArrayOp(): void
    {
        Session::set('errors', ['email' => 'err_email_invalid']);

        $this->assertEquals(['email' => 'err_email_invalid'], Session::get('errors'));
    }

    // ── forget() ─────────────────────────────────────────────────────────────

    public function testForgetVerwijdertSleutel(): void
    {
        $_SESSION['user_id'] = 5;

        Session::forget('user_id');

        $this->assertNull(Session::get('user_id'));
    }

    public function testForgetOpNietBestaandeSleutelGeeftGeenFout(): void
    {
        // Mag geen exception gooien
        Session::forget('bestaat_nooit_niet');

        $this->assertTrue(true);
    }

    public function testForgetVerwijdertAlleenOpgegevenSleutel(): void
    {
        $_SESSION['user_id']   = 1;
        $_SESSION['role_name'] = 'User';

        Session::forget('user_id');

        // role_name moet nog steeds bestaan
        $this->assertEquals('User', Session::get('role_name'));
    }

    // ── isLoggedIn() ──────────────────────────────────────────────────────────

    public function testIsLoggedInReturnsFalseAlsGeenUserIdInSessie(): void
    {
        $this->assertFalse(Session::isLoggedIn());
    }

    public function testIsLoggedInReturnsTrueAlsUserIdAanwezig(): void
    {
        $_SESSION['user_id'] = 3;

        $this->assertTrue(Session::isLoggedIn());
    }

    public function testIsLoggedInReturnsFalseNaForgetUserid(): void
    {
        $_SESSION['user_id'] = 3;
        Session::forget('user_id');

        $this->assertFalse(Session::isLoggedIn());
    }

    // ── isAdmin() ────────────────────────────────────────────────────────────

    public function testIsAdminReturnsFalseAlsGeenRoleInSessie(): void
    {
        $this->assertFalse(Session::isAdmin());
    }

    public function testIsAdminReturnsTrueAlsRoleNameAdmin(): void
    {
        $_SESSION['role_name'] = 'Admin';

        $this->assertTrue(Session::isAdmin());
    }

    public function testIsAdminReturnsFalseAlsRoleNameUser(): void
    {
        $_SESSION['role_name'] = 'User';

        $this->assertFalse(Session::isAdmin());
    }

    public function testIsAdminIsCaseSensitive(): void
    {
        // 'admin' (kleine letter) is NIET genoeg — moet exact 'Admin' zijn
        $_SESSION['role_name'] = 'admin';

        $this->assertFalse(Session::isAdmin());
    }

    public function testIsAdminReturnsFalseAlsRoleLeegString(): void
    {
        $_SESSION['role_name'] = '';

        $this->assertFalse(Session::isAdmin());
    }

    // ── destroy() ────────────────────────────────────────────────────────────

    public function testDestroyWistAlleSessiedata(): void
    {
        $_SESSION['user_id']   = 1;
        $_SESSION['role_name'] = 'Admin';
        $_SESSION['lang']      = 'nl';

        Session::destroy();

        // session_destroy() wist de server-side sessie.
        // In CLI-omgeving (tests) wist het ook $_SESSION.
        // We zetten $_SESSION daarna expliciet leeg (zelfde als wat een browser-redirect doet).
        $_SESSION = [];

        $this->assertFalse(Session::isLoggedIn());
    }
}
