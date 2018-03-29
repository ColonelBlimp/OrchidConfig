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

        if (empty($this->baseConfig) || !$this->isBaseConfigPropertiesSet()) {
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

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getConfigRoot()
     */
    public function getConfigRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->baseConfig[ConfigurationInterface::KEY_CONFIG_ROOT];
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getContentRoot()
     */
    public function getContentRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->baseConfig[ConfigurationInterface::KEY_CONTENT_ROOT];
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getCacheRoot()
     */
    public function getCacheRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->baseConfig[ConfigurationInterface::KEY_CACHE_ROOT];
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getThemesRoot()
     */
    public function getThemesRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->baseConfig[ConfigurationInterface::KEY_THEMES_ROOT];
    }

    /**
     * Checks that all the mandatory properties are set.
     * @return bool Return <code>true</code> if all the properties are set, otherwise <code>false</code>.
     */
    private function isBaseConfigPropertiesSet(): bool
    {
        return
            isset($this->baseConfig[ConfigurationInterface::KEY_APP_ROOT]) &&
            isset($this->baseConfig[ConfigurationInterface::KEY_CONFIG_ROOT]) &&
            isset($this->baseConfig[ConfigurationInterface::KEY_CACHE_ROOT]) &&
            isset($this->baseConfig[ConfigurationInterface::KEY_THEMES_ROOT]) &&
            isset($this->baseConfig[ConfigurationInterface::KEY_CONTENT_ROOT]);
    }
}
