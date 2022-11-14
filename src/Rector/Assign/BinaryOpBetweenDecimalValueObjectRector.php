<?php

declare(strict_types=1);

namespace Lendable\LendableRector\Rector\Assign;

use Lendable\ValueObject\MonetaryAmount;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class BinaryOpBetweenDecimalValueObjectRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Support binary operation between the appropriate value object',
            []
        );
    }

    public function getNodeTypes(): array
    {
        return [Node\Expr\BinaryOp::class];
    }

    /**
     * @param Node\Expr\BinaryOp $node
     */
    public function refactor(Node $node): ?Node
    {
        $parent = $node->getAttribute(AttributeKey::PARENT_NODE);

        if (!$parent instanceof Node\Expr\Assign) {
            return null;
        }

        if (!$this->canBeReplacedWithMethodCall($node)) {
            return null;
        }

        return $this->replaceBinaryOpWithMethodCall($node);
    }

    private function replaceBinaryOpWithMethodCall(Node\Expr\BinaryOp $node): Node\Expr\MethodCall
    {
        return new Node\Expr\MethodCall(
            $node->left instanceof Node\Expr\BinaryOp ? $this->replaceBinaryOpWithMethodCall($node->left) : $node->left,
            new Node\Identifier($this->getOperatorMethodName($node)),
            [new Node\Arg($node->right)]
        );
    }

    private function canBeReplacedWithMethodCall(Node\Expr\BinaryOp $node): bool
    {
        if ($node->left instanceof Node\Expr\BinaryOp) {
            return $this->canBeReplacedWithMethodCall($node->left);
        }

        $leftType = $this->getType($node->left);
        $rightType = $this->getType($node->right);

        if (!$leftType instanceof FullyQualifiedObjectType || !$rightType instanceof FullyQualifiedObjectType) {
            return false;
        }

        if ($rightType->getClassName() !== $leftType->getClassName()) {
            return false;
        }

        return $rightType->getClassName() === MonetaryAmount::class; // @TODO - naive implementation, to replace
    }

    private function getOperatorMethodName(Node\Expr\BinaryOp $node): string
    {
        // @TODO - naive implementation, to replace
        if ($node instanceof Node\Expr\BinaryOp\Plus) {
            return 'add';
        }

        if ($node instanceof Node\Expr\BinaryOp\Minus) {
            return 'subtract';
        }

        throw new \RuntimeException('Invalid node, expected binary operator');
    }
}