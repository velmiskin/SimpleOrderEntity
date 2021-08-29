<?php


namespace App\Entities;


use Ramsey\Uuid\UuidInterface;

class Product extends BaseEntity
{

    public function __construct(private string $name,
                                private float $price,
                                private float $weight,
                                private int $height,
                                private int $length,
                                private int $width,
                                UuidInterface $id)
    {
        parent::__construct($id);
    }

    /**
     * Return Product weight in kg
     *
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * Return Product height in mm
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Return Product length in mm
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Return Product width in mm
     *
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
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

    /**
     * Return Product Volume width in m2
     *
     * @return float
     */
    public function getProductVolume(): float
    {
        return $this->height * $this->length * $this->width / 100;
    }
}
