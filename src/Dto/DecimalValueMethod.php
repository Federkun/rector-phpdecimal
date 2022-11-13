<?php

declare(strict_types=1);

namespace Lendable\LendableRector\Dto;

final class DecimalValueMethod
{
    private function __construct(
        public readonly string $className,
        public readonly string $methodName,
        public readonly bool $isStatic
    ) {}

    public static function fromStaticMethod(
        string $className,
        string $methodName
    ) {
        return new self($className, $methodName, true);
    }
}