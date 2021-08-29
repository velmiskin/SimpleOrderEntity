<?php

namespace Tests\Feature;

use App\DTO\OrderDTO;
use App\Entities\DeliveryMethod;
use App\Entities\Order;
use App\Entities\OrderItem;
use App\Entities\OrderStatus\CreatedOrderStatus;
use App\Entities\PaymentMethod;
use App\Entities\Product;
use App\Entities\User;
use App\Exceptions\InvalidOrderException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class OrderTest extends TestCase
{

    private function createProductMock() : Product
    {
        return new Product('product_'.rand(0,100), 100, 1, 100, 100, 100,
            Uuid::uuid4());
    }

    private function createOrderItemMock() : OrderItem
    {
        return new OrderItem($this->createProductMock(), 3, Uuid::uuid4());
    }

    /**
     * @return OrderDTO
     */
    private function createOrderDtoMock(): OrderDTO
    {
        $orderDTO = new OrderDTO();
        $orderDTO->id = Uuid::uuid4();
        $orderDTO->deliveryMethod = new DeliveryMethod(2);
        $orderDTO->paymentMethod = new PaymentMethod(2);
        $orderDTO->user = $this->createMock(User::class);
        $orderDTO->items = collect([$this->createOrderItemMock()]);
        $orderDTO->statuses = collect([new CreatedOrderStatus(Uuid::uuid4(), now())]);

        return $orderDTO;
    }

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
        $orderDTO = $this->createOrderDtoMock();
        $product = $this->createProductMock();
        $orderItem = new OrderItem($product, 3, Uuid::uuid4());
        $order = new Order($orderDTO);
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
}
