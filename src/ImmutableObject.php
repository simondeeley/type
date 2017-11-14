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

use simondeeley\Type\ImmutableType;
use simondeeley\Helpers\ImmutableObjectHelperMethods;

/**
 * Immutable object
 *
 * This abstract class implements basic immutable functionaility. Any child
 * class would need to implement {@link getType}.
 *
 * @author  Simon Deeley <s.deeley@icloud.com>
 *
 * @abstract
 * @uses ImmutableObjectHelperMethods
 */
abstract class ImmutableObject implements ImmutableType
{
    use ImmutableObjectHelperMethods;

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
