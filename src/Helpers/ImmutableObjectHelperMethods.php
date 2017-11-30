<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Helpers;

use simondeeley\Exceptions\ImmutableMethodCallException;

/**
 * Helper trait to implement immutable objects
 *
 * Implements two basic methods to prevent accidental or implicit modification
 * of an objects properties.
 *
 * @author  Simon Deeley <s.deeley@icloud.com>
 */
trait ImmutableObjectHelperMethods
{
    /**
     * Prevent implicit setting of properties
     *
     * @param string $property - Property name to set
     * @param mixed $value - Mixed value to set property to
     * @return void
     * @throws ImmutableMethodCallException - Always throws an exception
     */
    final public function __set(string $property, $value): void
    {
        throw new ImmutableMethodCallException;
    }

    /**
     * Prevent implicit unsetting of properties
     *
     * @param string $property - Property name to set
     * @return void
     * @throws ImmutableMethodCallException - Always throws an exception
     */
    final public function __unset(string $property): void
    {
        throw new ImmutableMethodCallException;
    }
}
