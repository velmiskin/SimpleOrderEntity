<?php


namespace App\Entites;

use Ramsey\Uuid\UuidInterface;

class Order
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var DeliveryMethod
     */
    private $deliveryMethod;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var ProductItem[]
     */
    private $items;

    /**
     * @var User
     */
    private $user;

    /**
     * @var OrderStatus
     */
    private $status;

    public function __construct(UuidInterface $id, DeliveryMethod $deliveryMethod, PaymentMethod $paymentMethod,
                                array $items, User $user, OrderStatus $status)
    {
        $this->id = $id;
        $this->deliveryMethod = $deliveryMethod;
        $this->paymentMethod = $paymentMethod;
        $this->items = $items;
        $this->user = $user;
        $this->status = $status;

    }


}
