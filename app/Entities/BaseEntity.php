<?php


namespace App\Entities;


use Ramsey\Uuid\UuidInterface;

class BaseEntity
{

    /**
     * @var UuidInterface
     */
    public UuidInterface $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

}
