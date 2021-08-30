<?php

namespace Tests\Feature;

use App\DTO\OrderDTO;
use App\Entities\DeliveryMethod;
use App\Entities\Order;
use App\Entities\OrderItem;
use App\Entities\OrderStatus\CreatedOrderStatus;
use App\Entities\OrderStatus\WaitPaymentOrderStatus;
use App\Entities\PaymentMethod;
use App\Entities\Product;
use App\Exceptions\InvalidOrderException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Traits\MockCreationTrait;

class OrderTest extends TestCase
{
    use MockCreationTrait;

    public function testCreateOrder()
    {
        $order = $this->createMock(Order::class);
        $this->assertInstanceOf(Order::class, $order);
    }

    public function testNewOrderHasCreatedStatus()
    {
        $orderDTO = $this->createOrderDtoMock();
        $order = new Order($orderDTO);
        $this->assertInstanceOf(CreatedOrderStatus::class, $order->getLastStatus());
    }

    public function testNewOrderCantDuplicateCreatedStatus()
    {
        $this->expectException(InvalidOrderException::class);
        $orderDTO = $this->createOrderDtoMock();
        $order = new Order($orderDTO);
        $order->addOrderStatus(new CreatedOrderStatus(Uuid::uuid4(), now()));
    }

    public function testNewOrderCanAddItem()
    {
        $orderItem = new OrderItem($this->createProductMock(), 3, Uuid::uuid4());
        $order = new Order($this->createOrderDtoMock());
        $order->addOrderItem($orderItem);
        $this->assertEquals($order->getItems()->last(), $orderItem);
    }

    public function testNewOrderCantDuplicateProductItems()
    {
        $this->expectException(InvalidOrderException::class);
        $orderDTO = $this->createOrderDtoMock();
        $orderItem = $this->createOrderItemMock();
        $orderDTO->items = collect([$orderItem]);
        $order = new Order($orderDTO);
        $order->addOrderItem($orderItem);
    }

    public function testOrderAddWaitPaymentStatus()
    {
        $order = new Order($this->createOrderDtoMock());
        $order->addOrderStatus(new WaitPaymentOrderStatus());
        $this->assertInstanceOf(WaitPaymentOrderStatus::class, $order->getLastStatus());
    }

}
