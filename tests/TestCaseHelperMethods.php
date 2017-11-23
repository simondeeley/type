<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Tests;

use ReflectionClass;
use ReflectionMethod;

/**
 * Helper method for testing purposes
 *
 */
trait TestCaseHelperMethods
{
    /**
    * Data provider pre-fill
     *
     * @param   string $classname
     * @return  array
     */
    final private function getDataProviderArray(string $classname): array
    {
        return array_map(
            function (ReflectionMethod $method) {
                return [
                    $method->getName(),

                    // Method parameters
                    array_merge(
                        [array_rand(['foo', 'bar', 'baz'], 1)],
                        array_fill(
                            0,
                            count($method->getParameters() - 1),
                            $this->anything()
                        )
                    )
                ];
            },
            (new ReflectionClass($classname))->getMethods()
        );
    }
}
