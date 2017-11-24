<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Type;

/**
 * Type interface
 *
 * Contract describing methods that objects should implement when defining
 * themselves as 'Types'. This interface defines only one method, {@link getType}
 * which should return a string literal which describes the type of the class
 * in which it is implemented.
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 */
interface Type
{
    /**
     * Returns a description of the object
     *
     * Implementations of this method should return a string literal, for
     * example a class constant or computated value which ideally should be a
     * single word describing the type of the class, e.g. 'FOO'.
     * The method should always return a string literal and should not accept,
     * or rely on, parameters passed to it. Exceptions are not expected to be
     * thrown from implementations of this method.
     *
     * @static
     * @return string - Returns the name of the object type
     */
    public static function getType(): string;
}
