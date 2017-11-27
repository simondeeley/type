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
use simondeeley\Type\Type;
use simondeeley\Type\TypeEquality;

/**
 * Helper methods for TypeEquality
 *
 * This trait provides methods which utilise the flags described in
 * {@link TypeEquality} that can be called from TypeEquality::equals to help
 * determine if two objects are equal.
 *
 * @uses Type
 * @uses TypeEquality
 * @author Simon Deeley <s.deeley@icloud.com>
 */
trait TypeEqualityHelperMethods
{
    /**
     * Check against Type::getType
     *
     * Makes a comparison between two objects using the return values of
     * {@link Type::getType}. If both are equal then the method returns true,
     * otherwise false. Note that this method also returns true if the passed
     * flags are set to ignore this tye check.
     *
     * @param Type $type - the object to check against
     * @param int|null $flags - optional flags enable or disable certain checks
     * @return bool - Returns true if types are equal
     * @throws RuntimeException - if $this is not an instance of {@link Type}
     */
    final private function isSameTypeAs(Type $type, int $flags = null): bool
    {
        if ($flags & TypeEquality::IGNORE_OBJECT_TYPE) {
            return true; // Ignore this check and just return true
        }

        if (false === $this instanceof Type) {
            throw new RuntimeException(sprintf(
                'Cannot compare type equality as %s does not implement %s',
                get_class($this),
                Type::class
            ));
        }

        return ($this::getType() === $type::getType()) ? true : false;
    }

    /**
     * Check against an objects ID
     *
     * Makes a comparison against an objects identity, obtained through the use
     * of spl_object_hash. Method returns true if both objects point to the
     * same PHP reference. Note that this method also returns true when the $flag
     * is set to ignore this type of check.
     *
     * @param Type $type - the object to check against
     * @param int|null $flags - optional flags enable or disable certain checks
     * @return bool - Returns true if identities are equal
     */
    final private function isSameObjectAs(Type $type, int $flags = null): bool
    {
        if ($flags & TypeEquality::IGNORE_OBJECT_IDENTITY) {
            return true;
        }

        return (spl_object_hash($this) === spl_object_hash($type)) ? true : false;
    }
}
