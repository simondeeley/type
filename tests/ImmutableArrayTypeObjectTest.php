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

use RuntimeException;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use simondeeley\Type\ImmutableType;
use simondeeley\ImmutableArrayTypeObject;
use simondeeley\Helpers\ImmutableArrayHelperMethods;
use simondeeley\Helpers\ImmutableObjectHelperMethods;
use simondeeley\Tests\TestCaseHelperMethods;

/**
 * Test ImmutableArrayTypeObject
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 *
 * @uses TestCase
 * @uses TestCaseHelperMethods
 */
final class ImmutableArrayTypeObjectTest extends TestCase
{
    use TestCaseHelperMethods;

    /**
     * Test interface implementations
     *
     * @test
     * @return void
     */
    final public function classShouldImplementInterfaces(): void
    {
        $type = new ReflectionClass(ImmutableArrayTypeObject::class);

        $this->assertTrue($type->implementsInterface(ImmutableType::class));
        $this->assertTrue($type->implementsInterface(\ArrayAccess::class));
    }

    /**
     * Test class has methods
     *
     * @test
     * @dataProvider allMethods
     * @param string $method - Method name
     * @param array $parameter - The paramaters to pass
     * @return void
     */
    final public function classShouldHaveCorrectMethods(string $method, array $parameters): void
    {
        $type = new ReflectionClass(ImmutableArrayTypeObject::class);

        $this->assertTrue($type->hasMethod($method));
    }

    /**
     * Test exceptions are thrown
     *
     * @test
     * @dataProvider implementedMethods
     * @expectedException \RuntimeException
     * @param string $method - Method name
     * @param array $parameters - The paramaters to pass
     * @return void
     */
    final public function shouldThrowAnExceptions(string $method, array $parameters): void
    {
        $type = $this->getMockForAbstractClass(ImmutableArrayTypeObject::class);

        call_user_func_array(array($type, $method), $parameters);
    }

    /**
     * Return methods that should be present
     *
     * @see https://phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.data-providers
     *
     * @final
     * @return array
     */
    final public function allMethods(): array
    {
        return array_merge(
            $this->getDataProviderArray(ImmutableArrayTypeObject::class),
            $this->getDataProviderArray(\ArrayAccess::class)
        );
    }

    /**
     * Returns methods that should throw exception
     *
     * @see https://phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.data-providers
     *
     * @final
     * @return array
     */
    final public function implementedMethods(): array
    {
        return array_merge(
            $this->getDataProviderArray(ImmutableArrayHelperMethods::class),
            $this->getDataProviderArray(ImmutableObjectHelperMethods::class)
        );
    }
}
