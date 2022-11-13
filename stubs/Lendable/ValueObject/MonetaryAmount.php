<?php

declare(strict_types=1);

namespace Lendable\ValueObject;

class MonetaryAmount
{
    private function __construct()
    {
    }

    public static function fromFloat(float $amount): static
    {
        return new static();
    }

    public function add(self $amount): static
    {
        return new static();
    }

    public function subtract(self $amount): static
    {
        return new static();
    }
}