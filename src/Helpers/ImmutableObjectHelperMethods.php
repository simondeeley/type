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
     * @param string $property
     * @param mixed $value
     * @return void
     * @throws RuntimeException
     */
    final public function __set(string $property, $value): void
    {
        throw new RuntimeException(sprintf(
            'Cannot mutate property "%s" on immutable object %s',
            $property,
            get_class($this)
        ));
    }

    /**
     * Prevent implicit unsetting of properties
     *
     * @param string $property
     * @return void
     * @throws RuntimeException
     */
    final public function __unset(string $property): void
    {
        throw new RuntimeException(sprintf(
            'Cannot unset property "%s" on immutable object %s',
            $property,
            get_class($this)
        ));
    }
}