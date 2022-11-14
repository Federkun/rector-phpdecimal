<?php

declare(strict_types=1);

namespace Lendable\LendableRector\NodeAnalyzer;

use Lendable\LendableRector\Dto\DecimalValueWrapperCall;
use Lendable\ValueObject\MonetaryAmount;
use PhpParser\Node;
use PHPStan\Type\Type;
use Rector\Core\Reflection\ReflectionResolver;

final class DecimalValueReturnTypeAnalyzer
{
    public function __construct(
        private readonly ReflectionResolver $reflectionResolver
    ) {
    }

    // @TODO - naive implementation
    public function findDecimalValueWrapperCall(Node\Expr\MethodCall $node, Type $assignType): ?DecimalValueWrapperCall
    {
        $methodReflection = $this->reflectionResolver->resolveMethodReflectionFromMethodCall($node);
        $phpDoc = $methodReflection->getDocComment();

        if ($phpDoc === null) {
            return null;
        }

        if (!\str_contains($phpDoc, '@lendable-return')) {
            return null;
        }

        if (\str_contains($phpDoc, 'monetary-amount')) {
            if ($assignType->isFloat()) {
                return DecimalValueWrapperCall::fromStaticMethod(
                    MonetaryAmount::class,
                    'fromFloat'
                );
            }

            return null;
        }

        return null;
    }
}