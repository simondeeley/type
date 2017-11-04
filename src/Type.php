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
 * Immutable Type
 *
 * Describes methods that immutable objects should implement in order for them
 * to prevent implicit or accidental mutating of properties.
 */
interface Type
{
    /**
     * Allow read-only properties
     *
     * Since an object should be immutable it might be reasonable to allow
     * properties to be read-only. Implimenting this method can allow this.
     * However, an exception could be thrown if this functionality is not
     * desired.
     *
     * @param string $arg
     * @return mixed
     */
    public function __get(string $arg);

    /**
     * Prevent setting properties implicitly
     *
     * This method should always throw an exception when invoked to prevent
     * accidentally mutating an objects property through PHP's magic method
     * functionality.
     *
     * @param string $arg
     * @param mixed $value
     * @return void
     * @throws RuntimeException
     */
    public function __set(string $arg, $value): void;

    /**
     * Prevent unsetting of properties implicitly
     *
     * This method should always throw an exception when invoked to prevent
     * accidentally unsetting of an objects property through PHP's magic method
     * functionality.
     *
     * @param string $arg
     * @return void
     * @throws RuntimeException
     */
    public function __unset(string $arg): void;
}
