<?php


namespace App\Entities;

use App\DTO\OrderDTO;
use App\Entities\PaymentMethod;
use App\Entities\DeliveryMethod;
use App\Exceptions\InvalidOrderException;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Order
 * @package App\Entities
 */
class Order extends BaseEntity
{

    /**
     * @var DeliveryMethod
     */
    private DeliveryMethod $deliveryMethod;
    /**
     * @var PaymentMethod
     */
    private PaymentMethod $paymentMethod;
    /**
     * @var Collection
     */
    private Collection $items;
    /**
     * @var User
     */
    private User $user;
    /**
     * @var Collection
     */
    private Collection $statuses;

    public function __construct(OrderDTO $orderDTO)
    {
        parent::__construct($orderDTO->id);

        $this->deliveryMethod = $orderDTO->deliveryMethod;
        $this->paymentMethod = $orderDTO->paymentMethod;
        $this->items = $orderDTO->items;
        $this->statuses = $orderDTO->statuses;
        $this->user = $orderDTO->user;

    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    /**
     * @return OrderStatus
     */
    public function getLastStatus(): object
    {
        return $this->statuses->last();
    }

    /**
     * @return DeliveryMethod
     */
    public function getDeliveryMethod(): DeliveryMethod
    {
        return $this->deliveryMethod;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function getTotalOrderAmount(): float
    {
        return $this->items->sum(function (OrderItem $item) {
            return $item->getTotal();
        });
    }

    public function addOrderItems(Collection $items): void
    {
        $items->each(function ($item) {
            $this->addOrderItem($item);
        });
    }

    public function addOrderItem($newItem) : Collection | InvalidOrderException
    {
        if ($this->items->filter(function ($item) use ($newItem) {
            return $item->getProduct()->getId()->equals($newItem->getProduct()->getId());
        })->count()) {
            throw new InvalidOrderException('Product duplicate in order item list');
        }

        return $this->items->add($newItem);
    }

    public function addOrderStatuses(Collection $orderStatuses): void
    {
        $orderStatuses->each(function ($orderStatus) {
            $this->addOrderStatus($orderStatus);
        });
    }

    public function addOrderStatus($orderStatus) : Collection | InvalidOrderException
    {
        if ($this->statuses->filter(function ($status) use ($orderStatus) {
            return get_class($status) == get_class($orderStatus);
        })->count()) {
            throw new InvalidOrderException('Status duplicate in order status list');
        }

        return $this->statuses->add($orderStatus);
    }


}
