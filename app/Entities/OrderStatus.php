<?php


namespace App\Entities;


use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

abstract class OrderStatus extends BaseEntity
{
    private Carbon $created;

    public function __construct(UuidInterface $id, Carbon $created)
    {
        parent::__construct($id);

        $this->created = $created;

    }

    /**
     * @return Carbon
     */
    public function getCreated(): Carbon
    {
        return $this->created;
    }

}
