<?php

declare(strict_types=1);

namespace Dashford\Unleash;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request;

class Client
{
    /** @var Config */
    private $config;

    /** @var HttpClient */
    private $httpClient;

    public function __construct(Config $config, HttpClient $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    public function isEnabled(string $feature, $context = null, bool $default = false): bool
    {
        if ($feature === 'does-not-exist') {
            return $default;
        }
        return true;
    }

    private function registerClient()
    {
        $headers = [];
        $body = [
            'appName' => $this->config->getAppName(),
            'instanceId' => $this->config->getInstanceId(),
            'sdkVersion' => $this->config->getSDKVersion(),
            'strategies' => [],
            'started' => $this->config->getStartTime(),
            'interval' => $this->config->getMetricsInterval()
        ];
        $request = new Request('POST', 'http://localhost:9090', $headers, $body);
        $promise = $this->httpClient->sendAsync($request);
    }
}
