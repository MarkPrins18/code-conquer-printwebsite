<?php

/**
 * TestCase
 *
 * Basisklasse voor alle unit tests in dit project.
 * Biedt dezelfde assertion-methoden als PHPUnit zodat de tests
 * 1-op-1 werken zodra PHPUnit later wél geïnstalleerd wordt.
 *
 * Elke testmethode begint met 'test'.
 * setUp() wordt vóór elke test aangeroepen.
 * tearDown() wordt ná elke test aangeroepen.
 */
abstract class TestCase
{
    // Teller bijgehouden door de TestRunner
    public int $assertionCount = 0;

    // Wordt vóór elke testmethode aangeroepen — overschrijf in subklasse
    public function setUp(): void {}

    // Wordt ná elke testmethode aangeroepen — overschrijf in subklasse
    public function tearDown(): void {}

    // ── Assertions ────────────────────────────────────────────────────────────

    public function assertTrue(mixed $value, string $message = ''): void
    {
        $this->assertionCount++;
        if ($value !== true) {
            $got = var_export($value, true);
            throw new AssertionError(
                $message ?: "assertTrue mislukt: verwacht true, kreeg {$got}"
            );
        }
    }

    public function assertFalse(mixed $value, string $message = ''): void
    {
        $this->assertionCount++;
        if ($value !== false) {
            $got = var_export($value, true);
            throw new AssertionError(
                $message ?: "assertFalse mislukt: verwacht false, kreeg {$got}"
            );
        }
    }

    public function assertEquals(mixed $expected, mixed $actual, string $message = ''): void
    {
        $this->assertionCount++;
        if ($expected != $actual) {
            $exp = var_export($expected, true);
            $got = var_export($actual,   true);
            throw new AssertionError(
                $message ?: "assertEquals mislukt:\n  verwacht: {$exp}\n  gekregen: {$got}"
            );
        }
    }

    public function assertSame(mixed $expected, mixed $actual, string $message = ''): void
    {
        $this->assertionCount++;
        if ($expected !== $actual) {
            $exp = var_export($expected, true);
            $got = var_export($actual,   true);
            throw new AssertionError(
                $message ?: "assertSame mislukt:\n  verwacht: {$exp}\n  gekregen: {$got}"
            );
        }
    }

    public function assertNull(mixed $value, string $message = ''): void
    {
        $this->assertionCount++;
        if ($value !== null) {
            $got = var_export($value, true);
            throw new AssertionError(
                $message ?: "assertNull mislukt: verwacht null, kreeg {$got}"
            );
        }
    }

    public function assertNotNull(mixed $value, string $message = ''): void
    {
        $this->assertionCount++;
        if ($value === null) {
            throw new AssertionError(
                $message ?: 'assertNotNull mislukt: waarde is null'
            );
        }
    }

    public function assertEmpty(mixed $value, string $message = ''): void
    {
        $this->assertionCount++;
        if (!empty($value)) {
            $got = var_export($value, true);
            throw new AssertionError(
                $message ?: "assertEmpty mislukt: waarde is niet leeg: {$got}"
            );
        }
    }

    public function assertNotEmpty(mixed $value, string $message = ''): void
    {
        $this->assertionCount++;
        if (empty($value)) {
            throw new AssertionError(
                $message ?: 'assertNotEmpty mislukt: waarde is leeg'
            );
        }
    }

    public function assertCount(int $expected, array|Countable $value, string $message = ''): void
    {
        $this->assertionCount++;
        $actual = count($value);
        if ($expected !== $actual) {
            throw new AssertionError(
                $message ?: "assertCount mislukt: verwacht {$expected} items, kreeg {$actual}"
            );
        }
    }

    public function assertArrayHasKey(string|int $key, array $array, string $message = ''): void
    {
        $this->assertionCount++;
        if (!array_key_exists($key, $array)) {
            throw new AssertionError(
                $message ?: "assertArrayHasKey mislukt: sleutel '{$key}' niet gevonden"
            );
        }
    }

    public function assertArrayNotHasKey(string|int $key, array $array, string $message = ''): void
    {
        $this->assertionCount++;
        if (array_key_exists($key, $array)) {
            throw new AssertionError(
                $message ?: "assertArrayNotHasKey mislukt: sleutel '{$key}' wel gevonden"
            );
        }
    }

    public function assertStringContains(string $needle, string $haystack, string $message = ''): void
    {
        $this->assertionCount++;
        if (!str_contains($haystack, $needle)) {
            throw new AssertionError(
                $message ?: "assertStringContains mislukt: '{$needle}' niet gevonden in '{$haystack}'"
            );
        }
    }
}
