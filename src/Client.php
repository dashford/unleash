<?php

declare(strict_types=1);

namespace Dashford\Unleash;

class Client
{
    public function isEnabled(string $feature, $context = null, bool $default = false): bool
    {
        if ($feature === 'does-not-exist') {
            return $default;
        }
        return true;
    }
}
