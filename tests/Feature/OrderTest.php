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
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class OrderTest extends TestCase
{
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
        $orderDTO->items = collect([new OrderItem($this->createMock(Product::class),
            3, Uuid::uuid4())]);
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
}
