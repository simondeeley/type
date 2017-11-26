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
 * if the two objects are equal.
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 */
interface TypeEquality
{
    const STRICT_COMPARISON = 1;

    /**
     * Compare two {@link Type} objects
     *
     * Takes an {@link Type} object as an argument and compares it with itself
     * ($this) to determine equality between the two objects. Should return
     * boolean true if they are equal, false otherwise. The method may throw
     * an exception if an error occurrs when trying to compare the objects.
     *
     * @param Type $object - An object to test equality against
     * @param int|null $flags - Optional settings which can be passed to alter
     *                          the behaviour of the method
     * @return bool - Returns true if objects are equal
     * @throws InvalidArgumentException - Thrown if objects cannot be compared
     */
    public function equals(Type $object, int $flags = null): bool;
}
