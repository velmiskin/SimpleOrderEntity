<?php


namespace App\Entities;


/**
 * Class PaymentMethod
 * @package App\Entities
 */
class PaymentMethod
{
    public function __construct(private float $feeRatio)
    {
    }

    /**
     * @return float
     */
    public function getFeeRatio(): float
    {
        return $this->feeRatio;
    }

    /**
     * @param float $amount
     * @return float
     */
    public function calculateFee(float $amount): float
    {
        return $amount * $this->feeRatio;
    }
}
