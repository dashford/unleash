<?php

declare(strict_types=1);

namespace Dashford\Unleash;

class Config
{
    /** @var string */
    const VERSION = '0.0.1';

    /** @var int */
    const DEFAULT_METRICS_INTERVAL_IN_SECONDS = 60;

    /** @var string */
    private $appName;

    /** @var string */
    private $instanceId;

    /** @var string */
    private $sdkVersion = 'unleash-client-php:' . self::VERSION;

    /** @var int */
    private $metricsInterval = self::DEFAULT_METRICS_INTERVAL_IN_SECONDS;

    public function __construct()
    {
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

    public function build()
    {
        return $this;
    }
}
