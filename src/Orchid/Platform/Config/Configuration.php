<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

use Orchid\Constants;
use Orchid\Core\Config\PlatformConfigurationInterface;

/**
 * @author Marc L. Veary
 * @namespace Orchid\Platform\Config
 */
final class Configuration extends ConfigurationAbstract implements PlatformConfigurationInterface
{
    private $config = [];

    public function __construct(string $baseConfigFile = '', string $appConfigFile = '')
    {
        parent::__construct($baseConfigFile);

        $config = [];
        if (is_readable($appConfigFile)) {
            $this->config = json_decode(file_get_contents($appConfigFile), true);
        } elseif (is_readable($this->getConfigRoot().Constants::DS.Constants::FILE_PLATFORM_CONFIG_PHP)) {
            $this->config = include $this->getConfigRoot().Constants::DS.Constants::FILE_PLATFORM_CONFIG_PHP;
        }

    }


}
