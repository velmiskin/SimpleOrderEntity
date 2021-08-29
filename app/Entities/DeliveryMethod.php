<?php


namespace App\Entities;

use Illuminate\Support\Collection;

class DeliveryMethod
{
    public function __construct(private float $deliveryZoneRatio)
    {
    }

    public function calculateDeliveryPrice(Collection $items)
    {
        return $items->sum(function (OrderItem $item) {
            return $item->getQuantity() * $item->getProduct()->getProductVolume() * $this->deliveryZoneRatio;
        });
    }

}
