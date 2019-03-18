<?php

declare(strict_types=1);

namespace Dashford\Unleash\Tests;

use PHPUnit\Framework\TestCase;
use Dashford\Unleash\Config;

class ConfigTest extends TestCase
{
    public function testAppNameIsSet()
    {
        $config = new Config();
        $config->setAppName('app-name')->build();
        $this->assertSame('app-name', $config->getAppName());
    }

    public function testInstanceIdIsSet()
    {
        $config = new Config();
        $config->setInstanceId('instance-id')->build();
        $this->assertSame('instance-id', $config->getInstanceId());
    }

    public function testSDKVersionIsSet()
    {
        $config = new Config();
        $config->setSDKVersion('sdk-version')->build();
        $this->assertSame('sdk-version', $config->getSDKVersion());
    }

    public function testDefaultSDKVersionIsSet()
    {
        $config = new Config();
        $this->assertSame('unleash-client-php:0.0.1', $config->getSDKVersion());
    }

    public function testMetricsIntervalIsSet()
    {
        $config = new Config();
        $config->setMetricsInterval(100)->build();
        $this->assertSame(100, $config->getMetricsInterval());
    }

    public function testDefaultMetricsIntervalIsSet()
    {
        $config = new Config();
        $this->assertSame(60, $config->getMetricsInterval());
    }

    public function testClientStartingTime()
    {

    }
}
