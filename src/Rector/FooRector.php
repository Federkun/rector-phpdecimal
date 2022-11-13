<?php

declare(strict_types=1);

namespace Lendable\LendableRector\Rector;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Name;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class FooRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Adds the given set of interfaces to the classes extending the given type',
            [
                new CodeSample(
                    <<<CODE_SAMPLE
                    ...
                    CODE_SAMPLE,
                    <<<CODE_SAMPLE
                    ...
                    CODE_SAMPLE
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        $node->implements = [new Name(\ArrayAccess::class)];

        return $node;
    }
}