<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley;

use ArrayAccess;
use simondeeley\Type\ImmutableType;
use simondeeley\Helpers\ImmutableArrayHelperMethods;
use simondeeley\Helpers\ImmutableObjectHelperMethods;

/**
 * Immutable ArrayType object
 *
 * This abstract class implements basic immutable functionaility for an object
 * that can be accessed as an array. There are three methods to implement in any
 * child classes, {@link offsetGet}, {@link offsetExists} and {@link getType}.
 *
 * @author  Simon Deeley <s.deeley@icloud.com>
 *
 * @abstract
 * @uses ImmutableArrayHelperMethods
 * @uses ImmutableObjectHelperMethods
 */
abstract class ImmutableArrayTypeObject implements ImmutableType, ArrayAccess
{
    use ImmutableArrayHelperMethods, ImmutableObjectHelperMethods;

    /**
     * Get property
     *
     * @see http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @abstract
     * @param string $property
     * @return mixed
     */
    abstract public function offsetGet($property);

    /**
     * Check that a property exists
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @abstract
     * @param string $property
     * @return bool
     */
    abstract public function offsetExists($property);

    /**
     * Returns a description of the object
     *
     * @see Type
     *
     * @static
     * @abstract
     * @return string
     */
    abstract public static function getType(): string;
}
