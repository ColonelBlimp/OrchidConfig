<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

use Orchid\Core\Config\ConfigurationInterface;
use Orchid\Core\Exception\ConfigurationException;

abstract class ConfigurationAbstract implements ConfigurationInterface
{
    private const KEY_APP_ROOT = 'appRoot';

    private $baseConfig;

    public function __construct(string $baseConfigFile)
    {
        if (is_readable($baseConfigFile)) {
            $this->baseConfig = json_decode(file_get_contents($baseConfigFile), true);
        } elseif (is_readable(__DIR__.DIRECTORY_SEPARATOR.'config.json')) {
            $this->baseConfig = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'config.json'), true);
        }

        throw new ConfigurationException('Unable to locate a base configuration file to load.');
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getAppRoot()
     */
    public function getAppRoot(): string
    {
        return $this->baseConfig;
    }

    private function checkAndSetProperties(array $data)
    {
        if (isset($data[ConfigurationAbstract::KEY_APP_ROOT])) {
            $this->baseConfig = $data[ConfigurationAbstract::KEY_APP_ROOT];
        }
    }
}
