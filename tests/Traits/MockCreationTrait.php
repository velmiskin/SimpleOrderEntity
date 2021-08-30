<?php


namespace Tests\Traits;


use App\DTO\OrderDTO;
use App\Entities\DeliveryMethod;
use App\Entities\OrderItem;
use App\Entities\OrderStatus\CreatedOrderStatus;
use App\Entities\PaymentMethod;
use App\Entities\Product;
use App\Entities\User;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

trait MockCreationTrait
{
    private function faker() {
        return Factory::create();
    }

    private function createProductMock() : Product
    {
        return new Product($this->faker()->word(),
            $this->faker()->randomNumber(3, true),
            $this->faker()->randomNumber(2, true),
            $this->faker()->randomNumber(3, true),
            $this->faker()->randomNumber(3, true),
            $this->faker()->randomNumber(3, true),
            Uuid::uuid4());
    }

    private function createOrderItemMock() : OrderItem
    {
        return new OrderItem($this->createProductMock(), $this->faker()->randomDigit(), Uuid::uuid4());
    }

    private function createUser() : User
    {
        return new User($this->faker()->word(), $this->faker()->phoneNumber, $this->faker()->email, Uuid::uuid4());
    }

    /**
     * @return OrderDTO
     */
    private function createOrderDtoMock(): OrderDTO
    {
        $orderDTO = new OrderDTO();
        $orderDTO->id = Uuid::uuid4();
        $orderDTO->deliveryMethod = new DeliveryMethod($this->faker()->randomDigit());
        $orderDTO->paymentMethod = new PaymentMethod($this->faker()->randomDigit());
        $orderDTO->user = $this->createUser();
        $orderDTO->items = collect([$this->createOrderItemMock()]);
        $orderDTO->statuses = collect([new CreatedOrderStatus(Uuid::uuid4(), now())]);

        return $orderDTO;
    }

}
