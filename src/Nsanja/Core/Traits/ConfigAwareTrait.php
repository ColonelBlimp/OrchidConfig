<?php declare(strict_types = 1);

namespace Nsanja\Core\Traits;

use Nsanja\Core\Config\PlatformConfigurationInterface;

trait ConfigAwareTrait
{
    private $config;

    public function setConfig(PlatformConfigurationInterface $config): void
    {
        $this->config = $config;
    }
}
