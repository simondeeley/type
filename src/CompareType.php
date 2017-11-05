<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @author    Simon Deeley <s.deeley@icloud.com>
 * @copyright Simon Deeley 2017
 */

namespace simondeeley;

/**
 * Compare equality between two Type objects
 *
 * Interface for objects that can compare an object with itself to determine
 * if the two objects are equal.
 */
interface CompareType
{
    /**
     * Compare two {@link Type} objects
     *
     * Takes an {@link Type} object as an argument and compares it with itself
     * ($this) to determine equality between the two objects. Should return
     * boolean true if they are equal, false otherwise. The method may throw
     * an exception if an error occurrs when trying to compare the objects.
     *
     * @param Type $object
     * @return bool
     * @throws InvalidArgumentException
     */
    public function equals(Type $object): bool;
}
