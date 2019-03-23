<?php

declare(strict_types=1);

namespace Dashford\Unleash;

use Assert\Assert;
use Carbon\Carbon;
use InvalidArgumentException;

class Config
{
    /** @var string */
    const VERSION = '0.0.1';

    /** @var int */
    const DEFAULT_METRICS_INTERVAL_IN_SECONDS = 60;

    /** @var string */
    private $appName = null;

    /** @var string */
    private $instanceId = null;

    /** @var string */
    private $sdkVersion = 'unleash-client-php:' . self::VERSION;

    /** @var int */
    private $metricsInterval = self::DEFAULT_METRICS_INTERVAL_IN_SECONDS;

    /** @var \Carbon\CarbonInterface */
    private $startTime;

    /** @var bool */
    private $metricsEnabled = true;

    /** @var string */
    private $unleashApiUri = null;

    public function __construct()
    {
        $this->startTime = Carbon::now('UTC');
        return $this;
    }

    public function setAppName(string $appName)
    {
        $this->appName = $appName;
        return $this;
    }

    public function getAppName(): string
    {
        return $this->appName;
    }

    public function setInstanceId(string $instanceId)
    {
        $this->instanceId = $instanceId;
        return $this;
    }

    public function getInstanceId(): string
    {
        return $this->instanceId;
    }

    public function setSDKVersion(string $sdkVersion)
    {
        $this->sdkVersion = $sdkVersion;
        return $this;
    }

    public function getSDKVersion(): string
    {
        return $this->sdkVersion;
    }

    public function setMetricsInterval(int $metricsInterval)
    {
        $this->metricsInterval = $metricsInterval;
        return $this;
    }

    public function getMetricsInterval(): int
    {
        return $this->metricsInterval;
    }

    public function getStartTime(): string
    {
        return $this->startTime->toIso8601String();
    }

    public function enableMetrics()
    {
        $this->metricsEnabled = true;
        return $this;
    }

    public function disableMetrics()
    {
        $this->metricsEnabled = false;
        return $this;
    }

    public function areMetricsEnabled(): bool
    {
        return $this->metricsEnabled;
    }

    public function setUnleashApiUri(string $uri)
    {
        if (filter_var($uri, FILTER_VALIDATE_URL)) {
            $this->unleashApiUri = $uri;
            return $this;
        }
        throw new InvalidArgumentException('API URI must be a valid URI');
    }

    public function getUnleashApiUri()
    {
        return $this->unleashApiUri;
    }

    public function build()
    {
        Assert::lazy()
            ->that($this->appName, 'appName')->notNull()
            ->that($this->instanceId, 'instanceId')->notNull()
            ->that($this->unleashApiUri, 'unleashApiUri')->notNull()
            ->verifyNow();
        return $this;
    }
}
