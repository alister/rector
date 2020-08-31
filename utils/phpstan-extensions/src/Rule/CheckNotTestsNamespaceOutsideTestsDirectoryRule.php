<?php

declare(strict_types=1);

namespace Rector\PHPStanExtensions\Rule;

use PhpParser\Node;
use PhpParser\Node\Stmt\Namespace_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @see \Rector\PHPStanExtensions\Tests\Rule\CheckNotTestsNamespaceOutsideTestsDirectoryRule\CheckNotTestsNamespaceOutsideTestsDirectoryRuleTest
 */
class CheckNotTestsNamespaceOutsideTestsDirectoryRule implements Rule
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE = '"Tests" namespace (%s) used outside of "tests" directory (%s)';

    public function getNodeType(): string
    {
        return Namespace_::class;
    }

    /**
     * @param Namespace_ $node
     * @return string[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->name === null) {
            return [];
        }

        if (
            in_array('Tests', $node->name->parts, true) &&
            ! strstr($scope->getFileDescription(), '/tests/')
        ) {
            $errorMessage = sprintf(self::ERROR_MESSAGE, $node->name->toString(), $scope->getFileDescription());
            return [$errorMessage];
        }

        return [];
    }
}
