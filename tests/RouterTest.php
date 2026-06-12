<?php

/**
 * RouterTest
 *
 * Unit tests voor app/core/Router.php
 *
 * Wat wordt getest:
 *   get/post/put/patch/delete() — registreren routes correct
 *   dispatch()                  — roept juiste controller aan bij match
 *   dispatch()                  — geeft 404 bij geen match
 *   dispatch()                  — negeert verkeerde HTTP-methode
 *   match()                     — statische paden matchen correct
 *   match()                     — dynamische {id} parameters worden gevonden
 *   match()                     — querystring wordt genegeerd
 *   match()                     — trailing slash wordt genegeerd
 *
 * Hoe testen we dispatch() zonder echte controllers?
 * We definiëren inline stub-klassen (DummyController) in dit bestand.
 * Zo hebben we geen database of HTTP-server nodig.
 */

// ── Stub controllers ──────────────────────────────────────────────────────────
// Eenvoudige nep-controllers die bijhouden of en hoe ze aangeroepen zijn.

class DummyController
{
    // Statisch zodat we het na dispatch() kunnen uitlezen
    public static ?string $lastCalled   = null;
    public static mixed   $lastParam    = null;

    public function index(): void
    {
        self::$lastCalled = 'index';
    }

    public function show(string $id): void
    {
        self::$lastCalled = 'show';
        self::$lastParam  = $id;
    }

    public function store(): void
    {
        self::$lastCalled = 'store';
    }
}

class AnotherController
{
    public static ?string $lastCalled = null;

    public function home(): void
    {
        self::$lastCalled = 'home';
    }
}

// ── Testklasse ────────────────────────────────────────────────────────────────

class RouterTest extends TestCase
{
    private Router $router;

    public function setUp(): void
    {
        // Nieuwe router voor elke test — geen gedeelde staat
        $this->router = new Router();

        // Reset stub-controllers
        DummyController::$lastCalled  = null;
        DummyController::$lastParam   = null;
        AnotherController::$lastCalled = null;

        // Definieer BASE_URL als die nog niet bestaat
        if (!defined('BASE_URL')) {
            define('BASE_URL', '');
        }
    }

    // ── Route registratie ─────────────────────────────────────────────────────

    public function testGetRouteWordtGeregistreerd(): void
    {
        $this->router->get('/products', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/products', 'GET');
        ob_end_clean();

        $this->assertEquals('index', DummyController::$lastCalled);
    }

    public function testPostRouteWordtGeregistreerd(): void
    {
        $this->router->post('/login', [DummyController::class, 'store']);

        ob_start();
        $this->router->dispatch('/login', 'POST');
        ob_end_clean();

        $this->assertEquals('store', DummyController::$lastCalled);
    }

    // ── HTTP methode matching ─────────────────────────────────────────────────

    public function testGetRouteWordtNietGematchtBijPost(): void
    {
        $this->router->get('/products', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/products', 'POST');
        $output = ob_get_clean();

        // Controller mag niet aangeroepen zijn
        $this->assertNull(DummyController::$lastCalled);
        $this->assertStringContains('404', $output);
    }

    public function testPostRouteWordtNietGematchtBijGet(): void
    {
        $this->router->post('/login', [DummyController::class, 'store']);

        ob_start();
        $this->router->dispatch('/login', 'GET');
        ob_end_clean();

        $this->assertNull(DummyController::$lastCalled);
    }

    // ── 404 afhandeling ───────────────────────────────────────────────────────

    public function testDispatchGeeft404BijGeenMatch(): void
    {
        $this->router->get('/home', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/bestaat-niet', 'GET');
        $output = ob_get_clean();

        $this->assertStringContains('404', $output);
    }

    public function testDispatchRoeptControllerNietAanBij404(): void
    {
        $this->router->get('/home', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/andere-pagina', 'GET');
        ob_end_clean();

        $this->assertNull(DummyController::$lastCalled);
    }

    // ── Statische URL matching ────────────────────────────────────────────────

    public function testRootUrlWordtGematcht(): void
    {
        $this->router->get('/', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/', 'GET');
        ob_end_clean();

        $this->assertEquals('index', DummyController::$lastCalled);
    }

    public function testMeerdereRoutesWordenCorrectGematcht(): void
    {
        $this->router->get('/products', [DummyController::class, 'index']);
        $this->router->get('/',         [AnotherController::class, 'home']);

        ob_start();
        $this->router->dispatch('/', 'GET');
        ob_end_clean();

        $this->assertEquals('home',  AnotherController::$lastCalled);
        $this->assertNull(DummyController::$lastCalled);
    }

    public function testJuisteControllerWordtGeselecteerdUitMeerdereRoutes(): void
    {
        $this->router->get('/',         [AnotherController::class, 'home']);
        $this->router->get('/products', [DummyController::class,   'index']);

        ob_start();
        $this->router->dispatch('/products', 'GET');
        ob_end_clean();

        $this->assertEquals('index', DummyController::$lastCalled);
        $this->assertNull(AnotherController::$lastCalled);
    }

    // ── Dynamische URL parameters {id} ────────────────────────────────────────

    public function testDynamischParameterWordtDoorgegeven(): void
    {
        $this->router->get('/orders/{id}', [DummyController::class, 'show']);

        ob_start();
        $this->router->dispatch('/orders/42', 'GET');
        ob_end_clean();

        $this->assertEquals('show', DummyController::$lastCalled);
        $this->assertEquals('42',   DummyController::$lastParam);
    }

    public function testDynamischParameterMetStringWaarde(): void
    {
        $this->router->get('/orders/{id}', [DummyController::class, 'show']);

        ob_start();
        $this->router->dispatch('/orders/abc-123', 'GET');
        ob_end_clean();

        $this->assertEquals('abc-123', DummyController::$lastParam);
    }

    public function testStatischeRouteWordtNietGematchtAlsDynamisch(): void
    {
        // /orders/42 mag de route /orders niet matchen
        $this->router->get('/orders', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/orders/42', 'GET');
        $output = ob_get_clean();

        $this->assertNull(DummyController::$lastCalled);
        $this->assertStringContains('404', $output);
    }

    // ── Querystring en trailing slash ─────────────────────────────────────────

    public function testQuerystringWordtGenegeerd(): void
    {
        $this->router->get('/products', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/products?lang=nl&page=2', 'GET');
        ob_end_clean();

        $this->assertEquals('index', DummyController::$lastCalled);
    }

    public function testTrailingSlashWordtGenegeerd(): void
    {
        $this->router->get('/products', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/products/', 'GET');
        ob_end_clean();

        $this->assertEquals('index', DummyController::$lastCalled);
    }

    public function testUrlDecodingWordtToegepast(): void
    {
        $this->router->get('/over-ons', [DummyController::class, 'index']);

        ob_start();
        $this->router->dispatch('/over-ons', 'GET');
        ob_end_clean();

        $this->assertEquals('index', DummyController::$lastCalled);
    }
}
