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
 * Compare equality between two Type objects
 *
 * Interface for objects that can compare an object with itself to determine
 * if the two objects are equal. Uses bitwise flags to optionally exclude
 * comparisons that may be useful in comparing type equality. The following
 * flags are available:
 *
 * TypeEquality::IGNORE_OBJECT_TYPE - Set this flag to ignore the type of the
 * object which is set by Type::getType.
 *
 * TypeEquality::IGNORE_OBJECT_IDENTITY - Set this flag to ignore checking that
 * an object points to the same PHP reference, for example by checking the value
 * obtained by invoking spl_object_hash.
 *
 * Bitwise operators can be combined by using the pipe '|' operator, for example
 * $foo->equals($bar, TypeEquality::IGNORE_OBJECT_TYPE | TypeEquality::IGNORE_OBJECT_IDENTITY)
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 */
interface TypeEquality
{
    const IGNORE_OBJECT_TYPE = 0b0001;
    const IGNORE_OBJECT_IDENTITY = 0b0010;

    /**
     * Compare two {@link Type} objects
     *
     * Takes an {@link Type} object as an argument and compares it with itself
     * ($this) to determine equality between the two objects. Should return
     * boolean true if they are equal, false otherwise. The method may throw
     * an exception if an error occurrs when trying to compare the objects.
     *
     * @param Type $object - An object to test equality against
     * @param int $flags - Optional settings which can be passed to alter
     *                     the behaviour of the method
     * @return bool - Returns true if objects are equal
     * @throws InvalidArgumentException - Thrown if objects cannot be compared
     */
    public function equals(Type $object, int $flags = self::IGNORE_OBJECT_IDENTITY): bool;
}
