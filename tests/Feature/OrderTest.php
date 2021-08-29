<?php

namespace Tests\Feature;

use App\Entities\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testCreateOrder() {
        $order = $this->createMock(Order::class);
        $this->assertInstanceOf(Order::class, $order);
    }

}
