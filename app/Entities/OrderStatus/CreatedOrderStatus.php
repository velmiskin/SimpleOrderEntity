<?php


namespace App\Entities\OrderStatus;


use App\Entities\OrderStatus;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

/**
 * Class CreatedOrderStatus
 * @package App\Entities\OrderStatus
 */
final class CreatedOrderStatus extends OrderStatus
{

    public function __construct(UuidInterface $id, Carbon $created)
    {
        parent::__construct($id, $created);
    }
}
