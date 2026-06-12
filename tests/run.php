#!/usr/bin/env php
<?php

/**
 * TestRunner
 *
 * Voert alle tests in tests/ uit, toont kleurrijke CLI output
 * en genereert een HTML coverage rapport in tests/coverage/.
 *
 * Gebruik:
 *   php8.3 tests/run.php
 *   php8.3 tests/run.php --filter=SessionTest
 *   php8.3 tests/run.php --no-coverage
 */

// ── CLI argumenten ────────────────────────────────────────────────────────────
$filter     = null;
$doCoverage = true;

foreach ($argv as $arg) {
    if (str_starts_with($arg, '--filter=')) {
        $filter = substr($arg, 9);
    }
    if ($arg === '--no-coverage') {
        $doCoverage = false;
    }
}

// ── ANSI kleurcodes ───────────────────────────────────────────────────────────
$c = [
    'reset'   => "\033[0m",
    'bold'    => "\033[1m",
    'red'     => "\033[31m",
    'green'   => "\033[32m",
    'yellow'  => "\033[33m",
    'blue'    => "\033[34m",
    'cyan'    => "\033[36m",
    'white'   => "\033[37m",
    'bgRed'   => "\033[41m",
    'bgGreen' => "\033[42m",
];

// ── Bootstrap: laad de klassen die getest worden ──────────────────────────────
define('BASE_PATH', __DIR__ . '/..');

$coverageData = [];
// realpath() lost het relatieve pad op naar een absoluut pad zonder '..'
// zodat het overeenkomt met de sleutels die Xdebug intern gebruikt.
$coveredFiles = [
    realpath(BASE_PATH . '/app/core/Session.php'),
    realpath(BASE_PATH . '/app/core/Router.php'),
];

// ── Stap 1: coverage als ALLEREERSTE starten ──────────────────────────────────
// Xdebug kan alleen regels tellen van bestanden die worden ge-include NADAT
// xdebug_start_code_coverage() aangeroepen is. Productieklassen (Session, Router)
// worden via de autoloader geladen op het moment dat de tests ze voor het eerst
// gebruiken — dat is ná deze aanroep, dus worden ze correct getrackt.
if ($doCoverage && extension_loaded('xdebug')) {
    xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);
}

// ── Stap 2: sessie starten ────────────────────────────────────────────────────
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Stap 3: autoloader registreren ───────────────────────────────────────────
// Let op: autoloader alleen REGISTREREN hier, nog geen klassen laden.
// Productieklassen worden pril geladen bij eerste gebruik in de tests.
spl_autoload_register(function (string $class): void {
    $dirs = [
        BASE_PATH . '/app/core/',
        BASE_PATH . '/app/models/',
        BASE_PATH . '/app/controllers/',
        BASE_PATH . '/tests/',
    ];
    foreach ($dirs as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// ── Stap 4: laad testbestanden expliciet ──────────────────────────────────────
// TestCase.php eerst (basisklasse), dan de testklassen.
// Testbestanden bevatten GEEN productieklassen, dus dit vervuilt de coverage niet.
require_once __DIR__ . '/TestCase.php';
$testFiles = glob(__DIR__ . '/*Test.php');
foreach ($testFiles as $file) {
    require_once $file;
}

// ── Vind alle testklassen ─────────────────────────────────────────────────────
$testClasses = array_filter(
    get_declared_classes(),
    fn($c) => is_subclass_of($c, TestCase::class)
);

if ($filter) {
    $testClasses = array_filter($testClasses, fn($c) => str_contains($c, $filter));
}

// ── Coverage is al gestart vóór de autoloader (zie bootstrap bovenaan) ─────────

// ── Tests uitvoeren ───────────────────────────────────────────────────────────
$results         = [];
$totalPassed     = 0;
$totalFailed     = 0;
$totalAssertions = 0;
$startTime       = microtime(true);

echo "\n";
echo $c['bold'] . $c['cyan'] . " Bouw3D Unit Tests " . $c['reset'] . "\n";
echo $c['cyan']  . str_repeat('─', 60) . $c['reset'] . "\n\n";

foreach ($testClasses as $className) {
    echo $c['bold'] . $c['blue'] . "  {$className}" . $c['reset'] . "\n";

    $instance    = new $className();
    $methods     = array_filter(
        get_class_methods($className),
        fn($m) => str_starts_with($m, 'test')
    );

    $classPassed = 0;
    $classFailed = 0;

    foreach ($methods as $method) {
        $instance->assertionCount = 0;

        try {
            $instance->setUp();
            $instance->$method();
            $instance->tearDown();

            $assertions = $instance->assertionCount;
            $totalAssertions += $assertions;
            $totalPassed++;
            $classPassed++;

            $assertLabel = $assertions === 1 ? '1 assertion' : "{$assertions} assertions";
            echo $c['green'] . "    ✓ " . $c['reset']
               . str_pad($method, 50)
               . $c['cyan'] . " ({$assertLabel})" . $c['reset'] . "\n";

            $results[] = ['status' => 'passed', 'class' => $className, 'method' => $method];

        } catch (AssertionError $e) {
            $totalFailed++;
            $classFailed++;

            echo $c['red'] . "    ✗ " . $c['reset']
               . $c['bold'] . $method . $c['reset'] . "\n";
            echo $c['red'] . "      → " . $e->getMessage() . $c['reset'] . "\n";

            $results[] = ['status' => 'failed', 'class' => $className, 'method' => $method, 'error' => $e->getMessage()];

        } catch (Throwable $e) {
            $totalFailed++;
            $classFailed++;

            echo $c['red'] . "    ✗ " . $c['reset']
               . $c['bold'] . $method . $c['reset'] . "\n";
            echo $c['red'] . "      → " . get_class($e) . ': ' . $e->getMessage()
               . ' (regel ' . $e->getLine() . ' in ' . basename($e->getFile()) . ')' . $c['reset'] . "\n";

            $results[] = ['status' => 'error', 'class' => $className, 'method' => $method, 'error' => $e->getMessage()];
        }
    }

    echo "\n";
}

// ── Coverage stoppen ──────────────────────────────────────────────────────────
if ($doCoverage && extension_loaded('xdebug')) {
    $coverageData = xdebug_get_code_coverage();
    xdebug_stop_code_coverage();

}

// ── Samenvatting ──────────────────────────────────────────────────────────────
$elapsed = round((microtime(true) - $startTime) * 1000, 1);
$total   = $totalPassed + $totalFailed;

echo $c['cyan'] . str_repeat('─', 60) . $c['reset'] . "\n";

if ($totalFailed === 0) {
    echo $c['bgGreen'] . $c['bold'] . "  GESLAAGD  " . $c['reset'] . "  ";
} else {
    echo $c['bgRed']   . $c['bold'] . "  MISLUKT  "  . $c['reset'] . "  ";
}

echo $c['bold'] . "{$total} tests" . $c['reset'];
echo " ({$totalPassed} geslaagd";
if ($totalFailed > 0) {
    echo $c['red'] . ", {$totalFailed} mislukt" . $c['reset'];
}
echo "), {$totalAssertions} assertions, {$elapsed}ms\n";

// ── Coverage rapport ──────────────────────────────────────────────────────────
if ($doCoverage && !empty($coverageData)) {
    echo "\n" . $c['bold'] . $c['cyan'] . " Code Coverage" . $c['reset'] . "\n";
    echo $c['cyan'] . str_repeat('─', 60) . $c['reset'] . "\n";

    $coverageSummary = [];

    foreach ($coveredFiles as $filePath) {
        if (!file_exists($filePath)) continue;

        $lines      = file($filePath);
        $fileData   = $coverageData[$filePath] ?? [];
        $covered    = 0;
        $executable = 0;

        foreach ($fileData as $line => $count) {
            if ($count === -2) continue; // niet uitvoerbaar: commentaar/declaratie/lege regel
            $executable++;
            if ($count > 0) $covered++;  // > 0 = daadwerkelijk uitgevoerd
            // $count === -1 = uitvoerbaar maar NIET geraakt door tests
        }

        $pct     = $executable > 0 ? round(($covered / $executable) * 100) : 0;
        $barLen  = 30;
        $filled  = (int) round($pct / 100 * $barLen);
        $bar     = str_repeat('█', $filled) . str_repeat('░', $barLen - $filled);
        $color   = $pct >= 80 ? $c['green'] : ($pct >= 50 ? $c['yellow'] : $c['red']);
        $name    = basename($filePath);

        echo "  " . str_pad($name, 15)
           . " " . $color . $bar . $c['reset']
           . "  " . $color . $c['bold'] . str_pad($pct . '%', 5, ' ', STR_PAD_LEFT) . $c['reset']
           . "  ({$covered}/{$executable} regels)\n";

        $coverageSummary[$filePath] = [
            'name'       => $name,
            'pct'        => $pct,
            'covered'    => $covered,
            'executable' => $executable,
            'lines'      => $lines,
            'fileData'   => $fileData,
        ];
    }

    // Genereer HTML rapport
    generateHtmlReport($coverageSummary, $results, $totalPassed, $totalFailed, $totalAssertions);
    echo "\n" . $c['cyan'] . "  HTML rapport: " . $c['reset']
       . "tests/coverage/index.html\n";
}

echo "\n";

// Exitcode zodat CI pipelines de testuitslag kunnen gebruiken
exit($totalFailed > 0 ? 1 : 0);

// ── HTML rapport generator ────────────────────────────────────────────────────

function generateHtmlReport(array $coverageSummary, array $results, int $passed, int $failed, int $assertions): void
{
    $outputDir = __DIR__ . '/coverage';
    if (!is_dir($outputDir)) mkdir($outputDir, 0755, true);

    $now   = date('d-m-Y H:i:s');
    $total = $passed + $failed;

    // Bouw testtabel HTML
    $testRows = '';
    foreach ($results as $r) {
        $statusClass = $r['status'] === 'passed' ? 'passed' : 'failed';
        $statusIcon  = $r['status'] === 'passed' ? '✓' : '✗';
        $error       = htmlspecialchars($r['error'] ?? '');
        $errorHtml   = $error ? "<div class='error-msg'>→ {$error}</div>" : '';
        $errorCell   = $errorHtml ? "<td>{$errorHtml}</td>" : '<td></td>';
        $testRows   .= "<tr class='{$statusClass}'>
            <td class='icon'>{$statusIcon}</td>
            <td>{$r['class']}</td>
            <td>{$r['method']}</td>
            {$errorCell}
        </tr>";
    }

    // Bouw coverage sectie HTML
    $coverageRows = '';
    $sourceBlocks = '';
    foreach ($coverageSummary as $filePath => $info) {
        $pct   = $info['pct'];
        $color = $pct >= 80 ? '#4caf50' : ($pct >= 50 ? '#ff9800' : '#f44336');

        $coverageRows .= "<tr>
            <td><a href='#src-{$info['name']}'>{$info['name']}</a></td>
            <td>
                <div class='bar-bg'><div class='bar-fill' style='width:{$pct}%;background:{$color}'></div></div>
            </td>
            <td style='color:{$color};font-weight:bold'>{$pct}%</td>
            <td>{$info['covered']}/{$info['executable']} regels</td>
        </tr>";

        // Broncode annotatie
        $sourceHtml = '';
        foreach ($info['lines'] as $i => $line) {
            $lineNum  = $i + 1;
            $count    = $info['fileData'][$lineNum] ?? null;
            $cls      = match(true) {
                $count === null  => 'line-neutral',
                $count === -2    => 'line-neutral',
                $count > 0       => 'line-covered',
                default          => 'line-uncovered',
            };
            $countStr = $count > 0 ? "×{$count}" : ($count === -2 ? '' : ($count === null ? '' : '—'));
            $sourceHtml .= sprintf(
                "<div class='src-line %s'><span class='ln'>%4d</span><span class='cnt'>%s</span><span class='src'>%s</span></div>",
                $cls,
                $lineNum,
                htmlspecialchars($countStr),
                htmlspecialchars($line)
            );
        }

        $sourceBlocks .= "<div class='source-block' id='src-{$info['name']}'>
            <h3>{$info['name']} — {$pct}% gedekt</h3>
            <div class='source-code'>{$sourceHtml}</div>
        </div>";
    }

    $html = <<<HTML
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Bouw3D — Test Coverage Rapport</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'Segoe UI', sans-serif; background: #0f1117; color: #e0e0e0; margin: 0; padding: 2rem; }
    h1   { color: #ff6600; margin-bottom: 0.25rem; }
    h2   { color: #64b5f6; border-bottom: 1px solid #333; padding-bottom: 0.5rem; margin-top: 2rem; }
    h3   { color: #90caf9; font-size: 1rem; margin: 0 0 0.5rem; }
    .meta { color: #888; font-size: 0.9rem; margin-bottom: 2rem; }

    /* Samenvatting kaarten */
    .summary { display: flex; gap: 1.5rem; margin: 1.5rem 0; flex-wrap: wrap; }
    .card { background: #1e2230; border-radius: 0.75rem; padding: 1.25rem 2rem; min-width: 140px; text-align: center; }
    .card .num  { font-size: 2rem; font-weight: bold; }
    .card .lbl  { font-size: 0.85rem; color: #888; margin-top: 0.25rem; }
    .card.green .num { color: #4caf50; }
    .card.red   .num { color: #f44336; }
    .card.blue  .num { color: #64b5f6; }
    .card.gray  .num { color: #bbb; }

    /* Tabellen */
    table { width: 100%; border-collapse: collapse; background: #1e2230; border-radius: 0.75rem; overflow: hidden; }
    th    { background: #2a2d3e; padding: 0.75rem 1rem; text-align: left; color: #90caf9; font-size: 0.85rem; text-transform: uppercase; }
    td    { padding: 0.6rem 1rem; border-bottom: 1px solid #2a2d3e; font-size: 0.9rem; }
    tr.passed td { color: #e0e0e0; }
    tr.failed td { color: #ef9a9a; background: rgba(244,67,54,0.05); }
    .icon { font-size: 1rem; width: 2rem; }
    tr.passed .icon { color: #4caf50; }
    tr.failed .icon { color: #f44336; }
    .error-msg { font-size: 0.8rem; color: #f44336; margin-top: 0.2rem; font-family: monospace; }

    /* Coverage balk */
    .bar-bg   { background: #333; border-radius: 4px; height: 10px; width: 200px; }
    .bar-fill { height: 10px; border-radius: 4px; }

    /* Broncode */
    .source-block { margin: 1.5rem 0; background: #1e2230; border-radius: 0.75rem; overflow: hidden; padding: 1rem; }
    .source-code  { font-family: 'Consolas', monospace; font-size: 0.8rem; overflow-x: auto; }
    .src-line     { display: flex; line-height: 1.5; }
    .src-line:hover { background: rgba(255,255,255,0.04); }
    .ln  { color: #555; min-width: 3rem; text-align: right; padding-right: 1rem; user-select: none; }
    .cnt { color: #555; min-width: 3rem; text-align: right; padding-right: 1rem; user-select: none; font-size: 0.75rem; }
    .src { white-space: pre; }
    .line-covered   .ln  { color: #4caf50; }
    .line-covered   .src { color: #c8e6c9; }
    .line-covered   .cnt { color: #4caf50; }
    .line-uncovered .src { color: #ef9a9a; background: rgba(244,67,54,0.1); display: block; width: 100%; }
    .line-uncovered .ln  { color: #f44336; }
    .line-neutral   .src { color: #616161; }
  </style>
</head>
<body>
  <h1>Bouw³D — Test Coverage Rapport</h1>
  <p class="meta">Gegenereerd op {$now} &nbsp;·&nbsp; PHP 8.3 + Xdebug</p>

  <div class="summary">
    <div class="card green"><div class="num">{$passed}</div><div class="lbl">Geslaagd</div></div>
    <div class="card red">  <div class="num">{$failed}</div><div class="lbl">Mislukt</div></div>
    <div class="card blue"> <div class="num">{$total}</div> <div class="lbl">Totaal tests</div></div>
    <div class="card gray"> <div class="num">{$assertions}</div><div class="lbl">Assertions</div></div>
  </div>

  <h2>Testresultaten</h2>
  <table>
    <thead><tr><th></th><th>Klasse</th><th>Methode</th><th>Fout</th></tr></thead>
    <tbody>{$testRows}</tbody>
  </table>

  <h2>Code Coverage</h2>
  <table>
    <thead><tr><th>Bestand</th><th>Dekking</th><th>%</th><th>Regels</th></tr></thead>
    <tbody>{$coverageRows}</tbody>
  </table>

  <h2>Broncode annotatie</h2>
  <p style="color:#888;font-size:0.85rem">
    <span style="color:#4caf50">■</span> Uitgevoerd &nbsp;
    <span style="color:#f44336">■</span> Niet uitgevoerd &nbsp;
    <span style="color:#555">■</span> Niet uitvoerbaar (commentaar/declaratie)
  </p>
  {$sourceBlocks}
</body>
</html>
HTML;

    file_put_contents($outputDir . '/index.html', $html);
}
