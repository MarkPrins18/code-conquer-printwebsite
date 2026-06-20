<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../app/core/Router.php';

class TestController
{
    public static bool $indexCalled = false;
    public static bool $showCalled = false;
    public static bool $showOrderCalled = false;
    public static ?string $receivedId = null;
    public static ?string $receivedOrderId = null;

    public static function reset(): void
    {
        self::$indexCalled = false;
        self::$showCalled = false;
        self::$showOrderCalled = false;
        self::$receivedId = null;
        self::$receivedOrderId = null;
    }

    public function index(): void
    {
        self::$indexCalled = true;
    }

    public function show(string $id): void
    {
        self::$showCalled = true;
        self::$receivedId = $id;
    }

    public function showOrder(string $id, string $orderId): void
    {
        self::$showOrderCalled = true;
        self::$receivedId = $id;
        self::$receivedOrderId = $orderId;
    }
}

class RouterTest extends TestCase
{
    protected function setUp(): void
    {
        TestController::reset();
    }

    public function testGetRouteCallsControllerMethod(): void
    {
        $router = new Router();

        $router->get('/contact', [TestController::class, 'index']);

        $router->dispatch('/contact', 'GET');

        $this->assertTrue(TestController::$indexCalled);
    }

    public function testPostRouteCallsControllerMethod(): void
    {
        $router = new Router();

        $router->post('/contact', [TestController::class, 'index']);

        $router->dispatch('/contact', 'POST');

        $this->assertTrue(TestController::$indexCalled);
    }

    public function testRouteWithParameterPassesValue(): void
    {
        $router = new Router();

        $router->get('/users/{id}', [TestController::class, 'show']);

        $router->dispatch('/users/123', 'GET');

        $this->assertTrue(TestController::$showCalled);
        $this->assertSame('123', TestController::$receivedId);
    }

    public function testQueryStringIsIgnored(): void
    {
        $router = new Router();

        $router->get('/contact', [TestController::class, 'index']);

        $router->dispatch('/contact?foo=bar', 'GET');

        $this->assertTrue(TestController::$indexCalled);
    }

    public function testUrlEncodedCharactersAreDecoded(): void
    {
        $router = new Router();

        $router->get('/users/{id}', [TestController::class, 'show']);

        $router->dispatch('/users/test%20user', 'GET');

        $this->assertSame('test user', TestController::$receivedId);
    }

    public function testWrongHttpMethodDoesNotMatch(): void
    {
        $router = new Router();

        $router->get('/contact', [TestController::class, 'index']);

        ob_start();
        $router->dispatch('/contact', 'POST');
        $output = ob_get_clean();

        $this->assertFalse(TestController::$indexCalled);
        $this->assertSame('404 - Pagina niet gevonden', $output);
    }

    public function testUnknownRouteReturns404(): void
    {
        $router = new Router();

        ob_start();
        $router->dispatch('/bestaatniet', 'GET');
        $output = ob_get_clean();

        $this->assertSame('404 - Pagina niet gevonden', $output);
    }

    public function testControllerMethodNotFoundReturns500(): void
    {
        $router = new Router();

        $router->get('/contact', [TestController::class, 'bestaatNiet']);

        ob_start();
        $router->dispatch('/contact', 'GET');
        $output = ob_get_clean();

        $this->assertSame('500 - Methode niet gevonden', $output);
    }

    public function testTrailingSlashStillMatches(): void
    {
        $router = new Router();

        $router->get('/contact', [TestController::class, 'index']);

        $router->dispatch('/contact/', 'GET');

        $this->assertTrue(TestController::$indexCalled);
    }

    public function testRootRouteMatches(): void
    {
        $router = new Router();

        $router->get('/', [TestController::class, 'index']);

        $router->dispatch('/', 'GET');

        $this->assertTrue(TestController::$indexCalled);
    }

    public function testMultipleParametersArePassed(): void
    {
        $router = new Router();

        $router->get('/users/{id}/orders/{orderId}', [TestController::class, 'showOrder']);

        $router->dispatch('/users/42/orders/7', 'GET');

        $this->assertTrue(TestController::$showOrderCalled);
        $this->assertSame('42', TestController::$receivedId);
        $this->assertSame('7', TestController::$receivedOrderId);
    }

    public function testPutRouteCallsControllerMethod(): void
    {
        $router = new Router();

        $router->put('/users/{id}', [TestController::class, 'show']);

        $router->dispatch('/users/99', 'PUT');

        $this->assertTrue(TestController::$showCalled);
        $this->assertSame('99', TestController::$receivedId);
    }

    public function testPatchRouteCallsControllerMethod(): void
    {
        $router = new Router();

        $router->patch('/users/{id}', [TestController::class, 'show']);

        $router->dispatch('/users/99', 'PATCH');

        $this->assertTrue(TestController::$showCalled);
        $this->assertSame('99', TestController::$receivedId);
    }

    public function testDeleteRouteCallsControllerMethod(): void
    {
        $router = new Router();

        $router->delete('/users/{id}', [TestController::class, 'show']);

        $router->dispatch('/users/99', 'DELETE');

        $this->assertTrue(TestController::$showCalled);
        $this->assertSame('99', TestController::$receivedId);
    }
}