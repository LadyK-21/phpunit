<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\TestRunner;

use function sprintf;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;

/**
 * @immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final readonly class DeprecationTriggered implements Event
{
    private Telemetry\Info $telemetryInfo;

    /**
     * @var non-empty-string
     */
    private string $message;

    /**
     * @param non-empty-string $message
     */
    public function __construct(Telemetry\Info $telemetryInfo, string $message)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->message       = $message;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    /**
     * @return non-empty-string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return non-empty-string
     */
    public function asString(): string
    {
        return sprintf(
            'Test Runner Triggered Deprecation (%s)',
            $this->message,
        );
    }
}
