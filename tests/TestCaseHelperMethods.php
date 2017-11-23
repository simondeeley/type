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
     * Accepts a ReflectionMethod object and returns a pre-filled array of
     * parameters to test the method with.
     *
     * @param ReflectionMethod $method
     * @return array
     */
    final private function getMethodArray(ReflectionMethod $method): array
    {
        return [
            // Random method name
            $this->getRandomString('_'),

            // Method parameters
            array_fill(
                0,
                count($method->getParameters()),
                $this->getRandomString()
            )
        ];
    }

    /**
     * Return a random string
     *
     * @param string $prefix
     * @return string
     */
    final private function getRandomString(string $prefix = null): string
    {
        return (string) $prefix . substr(md5(microtime()), rand(0,99), 10);
    }
}
