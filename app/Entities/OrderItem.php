<?php


namespace App\Entities;


use Ramsey\Uuid\UuidInterface;

/**
 * Class OrderItem
 * @package App\Entities
 */
class OrderItem extends BaseEntity
{

    public function __construct(private Product $product,
                                private int $quantity,
                                UuidInterface $id)
    {
        parent::__construct($id);
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
