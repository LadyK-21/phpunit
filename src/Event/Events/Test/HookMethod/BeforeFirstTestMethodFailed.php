<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Test;

use const PHP_EOL;
use function sprintf;
use PHPUnit\Event\Code;
use PHPUnit\Event\Code\Throwable;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\Framework\TestCase;

/**
 * @immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final readonly class BeforeFirstTestMethodFailed implements Event
{
    private Telemetry\Info $telemetryInfo;

    /**
     * @var class-string<TestCase>
     */
    private string $testClassName;
    private Code\ClassMethod $calledMethod;
    private Throwable $throwable;

    /**
     * @param class-string<TestCase> $testClassName
     */
    public function __construct(Telemetry\Info $telemetryInfo, string $testClassName, Code\ClassMethod $calledMethod, Throwable $throwable)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->testClassName = $testClassName;
        $this->calledMethod  = $calledMethod;
        $this->throwable     = $throwable;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    /**
     * @return class-string<TestCase>
     */
    public function testClassName(): string
    {
        return $this->testClassName;
    }

    public function calledMethod(): Code\ClassMethod
    {
        return $this->calledMethod;
    }

    public function throwable(): Throwable
    {
        return $this->throwable;
    }

    /**
     * @return non-empty-string
     */
    public function asString(): string
    {
        $message = $this->throwable->message();

        if ($message !== '') {
            $message = PHP_EOL . $message;
        }

        return sprintf(
            'Before First Test Method Failed (%s::%s)%s',
            $this->calledMethod->className(),
            $this->calledMethod->methodName(),
            $message,
        );
    }
}
