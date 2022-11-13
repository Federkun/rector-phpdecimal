<?php

declare(strict_types=1);

namespace Lendable\LendableRector\Rector\Assign;

use Lendable\ValueObject\MonetaryAmount;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class WrapScalarValueIntoDecimalValueObjectRector extends AbstractRector
{
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
        $node->expr = new Node\Expr\StaticCall(
            new Node\Name\FullyQualified(MonetaryAmount::class), // @TODO, fetch it from phpdoc
            new Node\Identifier('fromFloat'),
            [
                new Node\Arg(
                    $node->expr
                )
            ]
        );

        return $node;
    }
}