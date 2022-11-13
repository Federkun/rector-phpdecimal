<?php

declare(strict_types=1);

namespace Lendable\ValueObject;

/**
 * @lendable-type monetary-amount
 */
class MonetaryAmount
{
    private function __construct()
    {
    }

    public static function fromFloat(float $amount): static
    {
        return new static();
    }

    /**
     * @lendable-test monetary-amount
     */
    public function add(self $amount): static
    {
        return new static();
    }

    public function subtract(self $amount): static
    {
        return new static();
    }
}