<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TestFixture\Event;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DataProviderNotIterableTest extends TestCase
{
    public static function provider(): string
    {
        return 'string';
    }

    #[DataProvider('provider')]
    public function testSomething(bool $value): void
    {
        $this->assertTrue($value);
    }
}
