<?php

declare(strict_types=1);

namespace Lendable\LendableRector\Rector\Assign;

use Lendable\LendableRector\NodeAnalyzer\ReturnTypeAnalyzer;
use Lendable\ValueObject\MonetaryAmount;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class PlusOpBetweenDecimalValueObjectRector extends AbstractRector
{
    public function __construct(
    ) {}

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Support addition between the appropriate value object',
            []
        );
    }

    public function getNodeTypes(): array
    {
        return [Node\Expr\BinaryOp\Plus::class];
    }

    /**
     * @param Node\Expr\BinaryOp\Plus $node
     */
    public function refactor(Node $node): ?Node
    {
        $parent = $node->getAttribute(AttributeKey::PARENT_NODE);

        if (!$parent instanceof Node\Expr\Assign) {
            return null;
        }

        if (!$this->canReplacePlusOpWithMethodCall($node)) {
            return null;
        }

        return new Node\Expr\MethodCall(
            $node->left,
            new Node\Identifier('add'),
            [
                new Node\Arg($node->right)
            ]
        );
    }

    private function canReplacePlusOpWithMethodCall(Node\Expr\BinaryOp\Plus $node): bool
    {
        $leftType = $this->getType($node->left);
        $rightType = $this->getType($node->right);

        if (!$leftType instanceof FullyQualifiedObjectType || !$rightType instanceof FullyQualifiedObjectType) {
            return false;
        }

        if ($rightType->getClassName() !== $leftType->getClassName()) {
            return false;
        }

        return $rightType->getClassName() === MonetaryAmount::class; // @TODO - native implementation
    }
}