<?php


namespace App\Entities;


use Ramsey\Uuid\UuidInterface;

abstract class BaseEntity
{

    /**
     * @var UuidInterface
     */
    protected UuidInterface $id;

    protected function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }


}
