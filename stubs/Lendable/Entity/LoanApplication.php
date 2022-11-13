<?php

declare(strict_types=1);

namespace Lendable\Entity;

use Lendable\ValueObject\MonetaryAmount;

class LoanApplication
{
    /**
     * @lendable-param MonetaryAmount
     */
    private float $amount;

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @lendable-param MonetaryAmount
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

}