<?php

declare(strict_types=1);

namespace Dashford\Unleash\Tests;

use Carbon\Carbon;
use Assert\LazyAssertionException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Dashford\Unleash\Config;

class ConfigTest extends TestCase
{
    public function testAppNameIsSet()
    {
        $config = new Config();
        $config->setAppName('app-name');
        $this->assertSame('app-name', $config->getAppName());
    }

    public function testInstanceIdIsSet()
    {
        $config = new Config();
        $config->setInstanceId('instance-id');
        $this->assertSame('instance-id', $config->getInstanceId());
    }

    public function testSDKVersionIsSet()
    {
        $config = new Config();
        $config->setSDKVersion('sdk-version');
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
        $config->setMetricsInterval(100);
        $this->assertSame(100, $config->getMetricsInterval());
    }

    public function testDefaultMetricsIntervalIsSet()
    {
        $config = new Config();
        $this->assertSame(60, $config->getMetricsInterval());
    }

    public function testStartingTime()
    {
        $knownDate = Carbon::create(2018, 01, 04, 07, 55, 37, 'UTC');
        Carbon::setTestNow($knownDate);
        $config = new Config();
        $this->assertSame('2018-01-04T07:55:37+00:00', $config->getStartTime());
        Carbon::setTestNow();
    }

    public function testDefaultMetricStateIsSet()
    {
        $config = new Config();
        $this->assertTrue($config->areMetricsEnabled());
    }

    public function testDisablingMetrics()
    {
        $config = new Config();
        $config->disableMetrics();
        $this->assertFalse($config->areMetricsEnabled());
    }

    public function testEnablingMetrics()
    {
        $config = new Config();
        $config->enableMetrics();
        $this->assertTrue($config->areMetricsEnabled());
    }

    public function testUnleashApiUriIsSet()
    {
        $config = new Config();
        $config->setUnleashApiUri('https://dashford.io/unleash/api');
        $this->assertSame('https://dashford.io/unleash/api', $config->getUnleashApiUri());
    }

    public function testInvalidUnleashApiUriThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $config = new Config();
        $config->setUnleashApiUri('this-is-not-a-uri');
    }

    public function testRequiredConfigParametersAreSet()
    {
        $config = new Config();
        $config->setAppName('test-app')
            ->setInstanceId('something-unique')
            ->setUnleashApiUri('https://dashford.io/unleash/api')
            ->build();
        $this->assertInstanceOf(Config::class, $config);
    }

    public function testExceptionIsThrownWhenMissingRequiredConfigParameters()
    {
        $this->expectException(LazyAssertionException::class);
        $config = new Config();
        $config->setAppName('test-app')
            ->build();
    }

    // Todo:
    // Refactor config instantiation in tests
    // Test default values must be set
}
