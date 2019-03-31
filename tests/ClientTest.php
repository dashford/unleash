<?php

declare(strict_types=1);

namespace Dashford\Unleash\Tests;

use Dashford\Unleash\Config;
use PHPUnit\Framework\TestCase;
use Dashford\Unleash\Client;

class ClientTest extends TestCase
{
    /** @var Config */
    private $mockConfig;

    /** @var \GuzzleHttp\Client */
    private $mockHttpClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockConfig = $this->createMock(Config::class);
        $this->mockHttpClient = $this->createMock(\GuzzleHttp\Client::class);
    }

    public function testRegistrationApiCallIsMade()
    {

    }

    public function testFeatureIsEnabled()
    {
        $client = new Client($this->mockConfig, $this->mockHttpClient);
        $this->assertTrue($client->isEnabled('test-feature'));
    }

    public function testDefaultValueIsReturned()
    {
        $client = new Client($this->mockConfig, $this->mockHttpClient);
        $this->assertFalse($client->isEnabled('does-not-exist', null, false));
        $this->assertTrue($client->isEnabled('does-not-exist', null, true));
    }
}
