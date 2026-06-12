<?php 

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../app/models/Order.php';

class OrderTest extends TestCase {
    public function testGetOrdersByUserId() {
        
        $fakeOrders = [
            [
                'order_id'        => 1,
                'bestel_datum'    => '2024-01-15 10:00:00',
                'status'          => 'In behandeling',
                'delivery_method' => 'ship',
                'delivery_address'=> 'Teststraat 1, Amsterdam',
                'order_total'     => '149.99',
            ]
        ];

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn($fakeOrders);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $order = new Order($pdoMock);
        $result = $order->getOrdersByUserId(24);

        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0]['order_id']);
        $this->assertEquals('In behandeling', $result[0]['status']);
        $this->assertEquals('149.99', $result[0]['order_total']);
    }

    public function testGetOrdersByUserIdNoOrders() {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')->willReturn([]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $order = new Order($pdoMock);
        $result = $order->getOrdersByUserId(999);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testGetAllOrders() {
        
        $fakeOrders = [
            [
                'order_id'        => 1,
                'bestel_datum'    => '2024-01-15 10:00:00',
                'status'          => 'In behandeling',
                'delivery_method' => 'ship',
                'delivery_address'=> 'Teststraat 1, Amsterdam',
                'order_total'     => '149.99',
                'email'           => 'test@example.com',
            ]
        ];

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn($fakeOrders);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $order = new Order($pdoMock);
        $result = $order->getAllOrders();

        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0]['order_id']);
        $this->assertEquals('In behandeling', $result[0]['status']);
        $this->assertEquals('149.99', $result[0]['order_total']);
        $this->assertEquals('test@example.com', $result[0]['email']);
    }

    public function testGetAllOrdersNoOrders() {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')->willReturn([]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $order = new Order($pdoMock);
        $result = $order->getAllOrders();

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testGetItemsByOrderId() {
        $fakeItems = [
            [
                'user_id' => 24,
                'order_id' => 1,
                'name' => 'testProduct',
                'quantity' => 2,
                'unit_price' => '49.99',
                'total_price' => '99.98',
            ]
        ];

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn($fakeItems);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $order = new Order($pdoMock);
        $result = $order->getItemsByOrderId(1);

        $this->assertCount(1, $result);
        $this->assertEquals('testProduct', $result[0]['name']);
        $this->assertEquals(2, $result[0]['quantity']);
        $this->assertEquals('49.99', $result[0]['unit_price']);
        $this->assertEquals('99.98', $result[0]['total_price']);
    }
}