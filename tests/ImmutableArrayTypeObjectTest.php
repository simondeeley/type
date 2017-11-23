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

use ReflectionClass;
use ReflectionMethod;
use PHPUnit\Framework\TestCase;
use simondeeley\Type\ImmutableArrayType;
use simondeeley\ImmutableArrayTypeObject;
use simondeeley\Helpers\ImmutableArrayHelperMethods;
use simondeeley\Helpers\ImmutableObjectHelperMethods;

/**
 * Test ImmutableArrayTypeObject
 *
 * @uses TestCase
 */
final class ImmutableArrayTypeObjectTest extends TestCase
{
    /**
     * Test interface implementations
     *
     * @test
     * @return void
     */
    final public function classShouldImplementInterfaces(): void
    {
        $type = new ReflectionClass(ImmutableArrayTypeObject::class);

        $this->assertTrue($type->implementsInterface(ImmutableArrayType::class));
        $this->assertTrue($type->implementsInterface(\ArrayAccess::class));
    }

    /**
     * Test class has methods
     *
     * @test
     * @dataProvider  allMethods
     * @return        void
     */
    final public function classShouldHaveCorrectMethods($method): void
    {
        $type = new ReflectionClass(ImmutableArrayTypeObject::class);

        $this->assertTrue($type->hasMethod($method));
    }

    /**
     * Test exceptions are thrown
     *
     * @test
     * @dataProvider      implementedMethods
     * @expectedException RuntimeException
     * @return            void
     */
    final public function shouldThrowAnException($method): void
    {
        $type = $this->getMockForAbstractClass(ImmutableArrayTypeObject::class);

        $type->$method();
    }

    /**
     * Return methods that should be present
     *
     * @final
     * @return array
     */
    final public function allMethods(): array
    {
        return [array_merge(
            (new ReflectionClass(ImmutableArrayTypeObject::class))->getMethods(),
            (new ReflectionClass(\ArrayAccess::class))->getMethods()
        )];
    }

    /**
     * Returns methods that should throw exception
     *
     * @final
     * @return array
     */
    final public function implementedMethods(): array
    {
        return [array_merge(
            (new ReflectionClass(ImmutableArrayHelperMethods::class))->getMethods(),
            (new ReflectionClass(ImmutableObjectHelperMethods::class))->getMethods()
        )];
    }
}
