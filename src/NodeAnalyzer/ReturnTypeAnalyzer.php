<?php

declare(strict_types=1);

namespace Lendable\LendableRector\NodeAnalyzer;

use Lendable\LendableRector\Dto\DecimalValueMethod;
use Lendable\ValueObject\MonetaryAmount;
use PhpParser\Node;
use PHPStan\Type\FloatType;
use PHPStan\Type\Type;
use Rector\Core\Reflection\ReflectionResolver;

final class ReturnTypeAnalyzer
{
    public function __construct(
        private readonly ReflectionResolver $reflectionResolver
    ) {
    }

    // @TODO - naive implementation
    public function findReturnType(Node\Expr\MethodCall $node, Type $assignType): ?DecimalValueMethod
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
            if (!$assignType instanceof FloatType) {
                return null;
            }

            return DecimalValueMethod::fromStaticMethod(MonetaryAmount::class, 'fromFloat');
        }

        return null;
    }
}