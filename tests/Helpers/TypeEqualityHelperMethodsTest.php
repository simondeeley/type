<?php
declare(strict_types=1);
/**
 * This file is part of the Type package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Tests\Helpers;

use simondeeley\Type\Type;
use simondeeley\Type\TypeEquality;
use simondeeley\Helpers\TypeEqualityHelperMethods;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for TestEquality helper methods
 *
 * @uses TestCase
 * @final
 * @author Simon Deeley <s.deeley@icloud.com>
 */
final class TypeEqualityHelperMethodsTest extends TestCase
{
    /**
     * Test methods with flags
     *
     * @test
     * @dataProvider sameTypeMethodData
     * @final
     * @param Type $subject - the subject {@link Type} object
     * @param Type $target - the target {@link Type} object
     * @param int $flags - the flags to test
     * @param bool $isSameTypeAs - the expected result
     * @param bool $isSameObjectAs - the expected result
     * @return void
     */
    final public function methodsShouldReturnCorrectBooleanValue(Type $subject, Type $target, int $flags, bool $isSameTypeAs, bool $isSameObjectAs): void
    {
        $this->assertEquals($isSameTypeAs, $subject->foo($target, $flags));
        $this->assertEquals($isSameObjectAs, $subject->bar($target, $flags));
    }

    /**
     * Test {@link TypeEquality::isSameTypeAs} throws exception
     *
     * @test
     * @expectedException RuntimeException
     * @final
     * @return void
     */
    final public function shouldThrowAnException(): void
    {
        $subject = new class { // Note does not implement correct interface
            use TypeEqualityHelperMethods {
                isSameTypeAs as public foo;
            }
        };

        $target = new class implements Type { // Correct interface
            final public static function getType(): string
            {
                return 'test';
            }
        };

        $subject->foo($target);
    }

    /**
     * Data provider
     *
     * @final
     * @return array
     */
    final public function sameTypeMethodData(): array
    {
        $one = new class implements Type {
            use TypeEqualityHelperMethods {
                isSameTypeAs as public foo;
            }

            use TypeEqualityHelperMethods {
                isSameObjectAs as public bar;
            }

            final public static function getType(): string
            {
                return 'test';
            }
        };

        $two = new class implements Type {
            final public static function getType(): string
            {
                return 'test';
            }
        };

        $three = new class implements Type {
            final public static function getType(): string
            {
                return 'bar';
            }
        };

        return [
            'Same object with flags set IGNORE_OBJECT_TYPE' => [
                $one,
                $one,
                TypeEquality::IGNORE_OBJECT_TYPE,
                true,
                true,
            ],

            'Same object with flags set IGNORE_OBJECT_IDENTITY' => [
                $one,
                $one,
                TypeEquality::IGNORE_OBJECT_IDENTITY,
                true,
                true,
            ],

            'Same object with flags set IGNORE_OBJECT_IDENTITY | IGNORE_OBJECT_IDENTITY' => [
                $one,
                $one,
                TypeEquality::IGNORE_OBJECT_IDENTITY | TypeEquality::IGNORE_OBJECT_IDENTITY,
                true,
                true,
            ],

            'Equal objects with flag set to IGNORE_OBJECT_TYPE' => [
                $one,
                $two,
                TypeEquality::IGNORE_OBJECT_TYPE,
                true,
                false,
            ],

            'Not equal objects with flag set to IGNORE_OBJECT_TYPE' => [
                $one,
                $three,
                TypeEquality::IGNORE_OBJECT_TYPE,
                true,
                false,
            ],

            'Equal objects with flag set to IGNORE_OBJECT_IDENTITY' => [
                $one,
                $two,
                TypeEquality::IGNORE_OBJECT_IDENTITY,
                true,
                false,
            ],

            'Not equal objects with flag set to IGNORE_OBJECT_IDENTITY' => [
                $one,
                $three,
                TypeEquality::IGNORE_OBJECT_IDENTITY,
                false,
                false,
            ],

            'Equal objects with flag set to IGNORE_OBJECT_TYPE | IGNORE_OBJECT_IDENTITY' => [
                $one,
                $two,
                TypeEquality::IGNORE_OBJECT_IDENTITY | TypeEquality::IGNORE_OBJECT_TYPE,
                true,
                true,
            ],

            'Not equal objects with flag set to IGNORE_OBJECT_TYPE | IGNORE_OBJECT_IDENTITY' => [
                $one,
                $three,
                TypeEquality::IGNORE_OBJECT_IDENTITY | TypeEquality::IGNORE_OBJECT_TYPE,
                true,
                true,
            ],
        ];
    }
}
