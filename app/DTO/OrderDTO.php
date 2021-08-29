<?php


namespace App\DTO;


use App\Entities\DeliveryMethod;
use App\Entities\PaymentMethod;
use App\Entities\User;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

class OrderDTO
{
    /**
     * @var UuidInterface
     */
    public UuidInterface $id;
    /**
     * @var DeliveryMethod
     */
    public DeliveryMethod $deliveryMethod;
    /**
     * @var PaymentMethod
     */
    public PaymentMethod $paymentMethod;
    /**
     * @var Collection
     */
    public Collection $items;
    /**
     * @var User
     */
    public User $user;
    /**
     * @var Collection
     */
    public Collection $statuses;

}
