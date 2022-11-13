<?php

declare(strict_types=1);

namespace Lendable\Entity;

class LoanApplication
{
    /**
     * @lendable-param monetary-amount
     */
    private float $amount;

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @lendable-return monetary-amount
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}