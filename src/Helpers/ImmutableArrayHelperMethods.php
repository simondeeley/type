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

use RuntimeException;

/**
 * Helper trait to implement immutable arrays
 *
 * Implements two basic methods to prevent accidental or implicit modification
 * of an arrays properties.
 *
 * @author  Simon Deeley <s.deeley@icloud.com>
 */
trait ImmutableArrayHelperMethods
{
    /**
     * Prevent implicit setting of properties
     *
     * @see http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param string $property
     * @param mixed $value
     * @return void
     * @throws RuntimeException
     */
    final public function offsetSet($property, $value)
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
     * @see http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param string $property
     * @return void
     * @throws RuntimeException
     */
    final public function offsetUnset($property)
    {
        throw new RuntimeException(sprintf(
            'Cannot unset property "%s" on immutable object %s',
            $property,
            get_class($this)
        ));
    }
}
