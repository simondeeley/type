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

use RuntimeException;
use InvalidArgumentException;

/**
 * Immutable Behaviour trait
 *
 * Add this trait to classes to prevent the default PHP magic methods from being
 * invoked which could cause an object to be mutatated implicitly.
 */
trait Immutability
{
    /**
     * Ensure properties are read-only
     *
     * @param string $arg
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get(string $arg)
    {
        if (property_exists($this, $arg)) {
            return $this->$arg;
        }

        throw new InvalidArgumentException(sprintf(
            'Property "%s" is not accessible on object %s',
            $arg,
            get_class($this)
        ));
   }

  /**
    * Override implicit setting of properties
    *
    * @param string $arg
    * @param mixed $value
    * @return void
    * @throws RuntimeException
    */
   final public function __set(string $arg, $value): void
   {
        throw new RuntimeException(sprintf(
            'Cannot mutate property "%s" on immutable object %s',
            $arg,
            get_class($this)
        ));
   }

    /**
     * Prevent implicit unsetting of properties
     *
     * @param string $arg
     * @return void
     * @throws RuntimeException
     */
    final public function __unset(string $arg): void
    {
        throw new RuntimeException(sprintf(
            'Cannot unset property "%s" on immutable object %s',
            $arg,
            get_class($this)
        ));
    }
}
