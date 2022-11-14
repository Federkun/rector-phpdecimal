<?php

declare(strict_types=1);

namespace Lendable\LendableRector\Rector\Assign;

use Lendable\LendableRector\NodeAnalyzer\DecimalValueReturnTypeAnalyzer;
use Lendable\ValueObject\MonetaryAmount;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class WrapScalarValueIntoDecimalValueObjectRector extends AbstractRector
{
    public function __construct(
        private readonly DecimalValueReturnTypeAnalyzer $returnTypeAnalyzer,
    ) {}

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Wrap float value into the appropriate value object',
            []
        );
    }

    public function getNodeTypes(): array
    {
        return [Node\Expr\Assign::class];
    }

    /**
     * @param Node\Expr\Assign $node
     */
    public function refactor(Node $node): ?Node
    {
        $methodCall = $node->expr;
        if (!$methodCall instanceof Node\Expr\MethodCall) {
            return null;
        }

        $type = $this->getType($node);

        $newMethodCall = $this->returnTypeAnalyzer->findDecimalValueWrapperCall($methodCall, $type);

        if ($newMethodCall === null) {
            return null;
        }

        if ($newMethodCall->isStatic) {
            return new Node\Expr\Assign(
                $node->var,
                new Node\Expr\StaticCall(
                    new Node\Name\FullyQualified($newMethodCall->className),
                    new Node\Identifier($newMethodCall->methodName),
                    [
                        new Node\Arg(
                            $node->expr
                        )
                    ]
                )
            );
        }

        return $node;
    }
}