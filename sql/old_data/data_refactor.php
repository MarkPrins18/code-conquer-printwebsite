<?php

require_once __DIR__ . '/config/init.php';

echo "START restructuring...\n";

/**
 * CONFIG
 */
$allowedKvks = [
    '87654321',
    '12345678',
    '23456789',
    '34567890'
];

/**
 * STEP 1: VALID USERS
 */
echo "Step 1: loading users...\n";

$stmt = $pdo->prepare("
    SELECT user_id
    FROM users
    WHERE kvk IN ('87654321','12345678','23456789','34567890')
");

$stmt->execute();
$validUsers = $stmt->fetchAll(PDO::FETCH_COLUMN);

if (!$validUsers) {
    die("No valid users found\n");
}

/**
 * STEP 2: LOAD ORDERS
 */
echo "Step 2: loading orders...\n";

$allOrders = $pdo->query("SELECT order_id FROM orders")->fetchAll(PDO::FETCH_COLUMN);

$total = count($allOrders);
echo "Total orders: $total\n";

/**
 * STEP 3: KEEP 1/3 RANDOM
 */
$keepCount = (int) floor($total / 3);

shuffle($allOrders);
$keepOrders = array_slice($allOrders, 0, $keepCount);

$keepMap = array_flip($keepOrders);

echo "Keeping: $keepCount orders\n";

/**
 * STEP 4: DELETE 2/3 ORDERS
 */
echo "Step 3: deleting orders...\n";

foreach ($allOrders as $orderId) {
    if (!isset($keepMap[$orderId])) {
        $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->execute([$orderId]);
    }
}

/**
 * STEP 5: RELOAD REMAINING ORDERS
 */
echo "Step 4: reloading orders...\n";

$validOrders = $pdo->query("SELECT order_id FROM orders")->fetchAll(PDO::FETCH_COLUMN);

/**
 * STEP 6: REASSIGN ORDERS TO USERS
 */
echo "Step 5: reassigning orders...\n";

$stmtUpdateOrder = $pdo->prepare("
    UPDATE orders
    SET user_id = :user_id
    WHERE order_id = :order_id
");

foreach ($validOrders as $orderId) {

    $randomUser = $validUsers[array_rand($validUsers)];

    $stmtUpdateOrder->execute([
        'user_id' => $randomUser,
        'order_id' => $orderId
    ]);
}

/**
 * STEP 7: FIX ORDER LINE ITEMS (SAFE REBIND)
 */
echo "Step 6: fixing order line items...\n";

/**
 * Load valid order IDs
 */
$validOrderIds = array_flip(
    $pdo->query("SELECT order_id FROM orders")->fetchAll(PDO::FETCH_COLUMN)
);

/**
 * Load existing PK combinations
 */
$existing = [];

$stmt = $pdo->query("
    SELECT order_id, product_id
    FROM order_line_items
");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $existing[$row['order_id'] . '-' . $row['product_id']] = true;
}

/**
 * Load all items
 */
$items = $pdo->query("
    SELECT order_id, product_id
    FROM order_line_items
")->fetchAll(PDO::FETCH_ASSOC);

/**
 * Update statement
 */
$update = $pdo->prepare("
    UPDATE order_line_items
    SET order_id = :new_order_id
    WHERE order_id = :old_order_id
    AND product_id = :product_id
");

/**
 * REBIND LOOP (FIXED VERSION)
 */
foreach ($items as $item) {

    $oldKey = $item['order_id'];

    // alleen als order niet meer bestaat
    if (!isset($validOrderIds[$oldKey])) {

        $tries = 0;
        $moved = false;

        while ($tries < 20 && !$moved) {

            $newOrder = $validOrders[array_rand($validOrders)];
            $key = $newOrder . '-' . $item['product_id'];

            if (!isset($existing[$key])) {

                $update->execute([
                    'new_order_id' => $newOrder,
                    'old_order_id' => $item['order_id'],
                    'product_id' => $item['product_id']
                ]);

                $existing[$key] = true;
                $moved = true;
            }

            $tries++;
        }
    }
}

echo "DONE restructuring!\n";