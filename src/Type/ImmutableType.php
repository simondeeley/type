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
 * Immutable Type
 *
 * Describes methods that immutable objects should implement in order for them
 * to prevent implicit or accidental mutating of properties. Describing two
 * methods, {@link __set} and {@link __unset} which are two of PHP's magic
 * methods which can mutate objects if they are not correctly implemented. Here,
 * each should throw an exception to prevent such mutations.
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 */
interface ImmutableType extends Type
{
    /**
     * Prevent setting properties
     *
     * This method should always throw an exception when invoked to prevent
     * accidentally mutating an objects property through PHP's magic method
     * functionality.
     * The two parameters it accepts, $arg and $value are from the default
     * implementation of {@link __set} which accept the name of the property to
     * set and its value, respectively.
     *
     * @see http://php.net/manual/en/language.oop5.overloading.php#object.set
     *
     * @param string $property - Property name to set
     * @param mixed $value - Mixed value to set property to
     * @return void
     * @throws RuntimeException - Always throws an exception
     */
    public function __set(string $property, $value): void;

    /**
     * Prevent unsetting of properties
     *
     * This method should always throw an exception when invoked to prevent
     * accidentally unsetting of an objects property through PHP's magic method
     * functionality.
     * The $arg parameter is from the default implementation of {@link __unset}
     * which is the name of the parameter to unset on the object.
     *
     * @see http://php.net/manual/en/language.oop5.overloading.php#object.unset
     *
     * @param string $property - Property name to set
     * @return void
     * @throws RuntimeException - Always throws an exception
     */
    public function __unset(string $property): void;
}
