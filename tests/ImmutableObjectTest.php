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
use simondeeley\ImmutableObject;

/**
 * Test ImmutableArrayTypeObject
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 * @uses ImmutableObject
 */
final class ImmutableObjectTest extends TestCase
{
    /**
     * Test ImmutableObject prevents setting properties
     *
     * @test
     * @expectedException simondeeley\Exceptions\ImmutableMethodCallException
     * @final
     * @return void
     */
    final public function shouldThrowExceptionWhenMagicSetIsCalled(): void
    {
        $object = $this->getMockForAbstractClass(ImmutableObject::class);

        $object->foo = 'test';
    }

    /**
     * Test ImmutableObject prevents unsetting properties
     *
     * @test
     * @expectedException simondeeley\Exceptions\ImmutableMethodCallException
     * @final
     * @return void
     */
    final public function shouldThrowExceptionWhenMagicUnsetIsCalled(): void
    {
        $object = $this->getMockForAbstractClass(ImmutableObject::class);

        unset($object->foo);
    }
}
