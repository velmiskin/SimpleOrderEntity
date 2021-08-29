<?php


namespace App\Entities;


use Ramsey\Uuid\UuidInterface;

class Product extends BaseEntity
{

    public function __construct(private string $name,
                                private float $price,
                                UuidInterface $id)
    {
        parent::__construct($id);
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
