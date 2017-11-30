<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Tests;

use PHPUnit\Framework\TestCase;
use simondeeley\ImmutableArrayTypeObject;

/**
 * Test ImmutableArrayTypeObject
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 * @uses ImmutableArrayTypeObject
 */
final class ImmutableArrayTypeObjectTest extends TestCase
{
    /**
     * Test ImmutableObject prevents setting offsets
     *
     * @test
     * @expectedException simondeeley\Exceptions\ImmutableMethodCallException
     * @final
     * @return void
     */
    final public function shouldThrowExceptionWhenOffsetSetIsCalled(): void
    {
        $object = $this->getMockForAbstractClass(ImmutableArrayTypeObject::class);

        $object['foo'] = 'test';
    }

    /**
     * Test ImmutableObject prevents calling offsetUnset
     *
     * @test
     * @expectedException simondeeley\Exceptions\ImmutableMethodCallException
     * @final
     * @return void
     */
    final public function shouldThrowExceptionWhenOffsetUnsetIsCalled(): void
    {
        $object = $this->getMockForAbstractClass(ImmutableArrayTypeObject::class);

        unset($object['foo']);
    }
}
