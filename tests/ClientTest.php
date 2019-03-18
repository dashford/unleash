<?php

declare(strict_types=1);

namespace Dashford\Unleash\Tests;

use PHPUnit\Framework\TestCase;
use Dashford\Unleash\Client;

class ClientTest extends TestCase
{
    public function testFeatureIsEnabled()
    {
        $client = new Client();
        $this->assertTrue($client->isEnabled('test-feature'));
    }

    public function testDefaultValueIsReturned()
    {
        $client = new Client();
        $this->assertFalse($client->isEnabled('does-not-exist', null, false));
        $this->assertTrue($client->isEnabled('does-not-exist', null, true));
    }
}
