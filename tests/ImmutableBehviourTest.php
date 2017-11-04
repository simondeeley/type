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

namespace simondeeley\Tests;

use RuntimeException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use simondeeley\ImmutableBehaviour;

/**
 * Test immuatble behaviour
 *
 */
final class ImmutableBehaviourTest extends TestCase
{
    /**
     * @var object
     */
    protected static $immutable;

    public static function setUpBeforeClass()
    {
        self::$immutable = new class {
            use ImmutableBehaviour;

            protected $foo = 'Foo';
        };
    }

    public function testShouldAllowReadingOfProperty(): void
    {
        $this->assertTrue(self::$immutable->foo === 'Foo');
    }

    public function testShouldThrowExceptionIfPropertyDoesNotExist(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $bar = self::$immutable->bar;
    }

    public function testShouldPreventMutatingProperties(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageRegExp('"foo"');

        self::$immutable->foo = 'bar';
    }

    public function testShouldPreventSettingNewProperty(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageRegExp('"bar"');

        self::$immutable->bar = 'baz';
    }

    public function testShouldPreventUnsettingProperties(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageRegExp('"foo"');

        unset(self::$immutable->foo);
    }
}
