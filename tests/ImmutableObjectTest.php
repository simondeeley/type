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
use simondeeley\Type\ImmutableType;
use simondeeley\ImmutableObject;
use simondeeley\Helpers\ImmutableObjectHelperMethods;

/**
 * Test ImmutableArrayTypeObject
 *
 * @uses TestCase
 */
final class ImmutableObjectTest extends TestCase
{
    /**
     * Test interface implementations
     *
     * @test
     * @return void
     */
    final public function classShouldImplementInterfaces(): void
    {
        $type = new ReflectionClass(ImmutableObject::class);

        $this->assertTrue($type->implementsInterface(ImmutableType::class));
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
        $type = new ReflectionClass(ImmutableObject::class);

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
        $type = $this->getMockForAbstractClass(ImmutableObject::class);

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
        return (new ReflectionClass(ImmutableType::class))->getMethods();
    }

    /**
     * Returns methods that should throw exception
     *
     * @final
     * @return array
     */
    final public function implementedMethods(): array
    {
        return (new ReflectionClass(ImmutableObjectHelperMethods::class))->getMethods();
    }
}
