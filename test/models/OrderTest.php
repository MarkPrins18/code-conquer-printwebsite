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

        $stmtMock = $this->createMock(PDOstatement::class);

        $stmtMock->expects($this->once())
                 ->method('execute')
                 ->with(['user_id' => 24]);

        $stmtMock->expects($this->once())   
                 ->method('fetchAll')
                 ->with(PDO::FETCH_ASSOC)
                 ->willReturn($fakeOrders);
                 
        $pdoMock = $this->createMock(PDO::class);

        $pdoMock->expects($this->once())
                        ->method('prepare')
                        ->willReturn($stmtMock); 

        $order = new Order($pdoMock);

        $result = $order->getOrdersByUserId(24);

        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0]['order_id']);
        $this->assertEquals('In behandeling', $result[0]['status']);
        $this->assertEquals('149.99', $result[0]['order_total']);

    }

      public function testgetOrdersByUserIdNoOrders() {
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
}
