<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

use Orchid\Constants;
use Orchid\Core\Config\ConfigurationInterface;
use Orchid\Core\Exception\ConfigurationException;

abstract class ConfigurationAbstract implements ConfigurationInterface
{
    private $baseConfig = [];

    public function __construct(string $baseConfigFile)
    {
        if (is_readable($baseConfigFile)) {
            $this->baseConfig = json_decode(file_get_contents($baseConfigFile), true);
        } elseif (is_readable(__DIR__.Constants::DS.'Configs.php')) {
            $this->baseConfig = include 'Configs.php';
        }

        if (empty($this->baseConfig) || !$this->isBaseConfigValid()) {
            throw new ConfigurationException('A base configuration file was not loaded.');
        }
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getAppRoot()
     */
    public function getAppRoot(): string
    {
        return realpath($this->baseConfig[ConfigurationInterface::KEY_APP_ROOT]);
    }

    public function getConfigRoot(): string
    {
        return $this->getAppRoot().$this->baseConfig[ConfigurationInterface::KEY_CONFIG_ROOT];
    }

    public function getContentRoot(): string
    {
        return $this->getAppRoot().$this->baseConfig[ConfigurationInterface::KEY_CONTENT_ROOT];
    }

    private function isBaseConfigValid(): bool
    {
        return
            isset($this->baseConfig[ConfigurationInterface::KEY_APP_ROOT]) &&
            isset($this->baseConfig[ConfigurationInterface::KEY_CONFIG_ROOT]) &&
            isset($this->baseConfig[ConfigurationInterface::KEY_CONTENT_ROOT]);
    }
}
