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
     * Merge one or more methods to test
     *
     * @param   string $classname
     * @return  array
     */
    final private function getDataProviderArray(string $classname): array
    {
        return array_map(
            function (ReflectionMethod $method) {
                return $this->getMethodArray($method);
            },
            (new ReflectionClass($classname))->getMethods()
        );
    }

    /**
     * Data provider pre-fill
     *
     * Accepts a ReflectionMethod object and returns a pre-filled array of
     * parameters to test the method with.
     *
     * @param   ReflectionMethod $method
     * @return  array
     */
    final private function getMethodArray(ReflectionMethod $method): array
    {
        return [
            $method->getName(),

            // Method parameters
            array_merge(
                [array_rand(['foo', 'bar', 'baz'], 1)],
                array_fill(
                    0,
                    count($method->getParameters()),
                    $this->anything()
                )
            )
        ];
    }
}
