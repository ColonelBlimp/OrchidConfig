<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

use Orchid\Core\Constants;
use Orchid\Core\Config\ConfigurationInterface;
use Orchid\Core\Exception\ConfigurationException;

/**
 * This abstract class handles all the base platform configuration.
 * @author Marc L. Veary
 * @namespace Orchid\Platform\Config
 * @package Orchid
 */
abstract class ConfigurationAbstract implements ConfigurationInterface
{
    protected $config = [];

    /**
     * Constructor.
     * @param string $baseConfigFile
     * @throws ConfigurationException
     */
    public function __construct(string $baseConfigFile = null)
    {
        if ($baseConfigFile === null) {
            $baseConfigFile = __DIR__.Constants::DS.'BaseConfig.php';
        }

        if (is_readable($baseConfigFile)) {
            $this->config = include $baseConfigFile;
        }

        if (empty($this->config) || !$this->isBaseConfigPropertiesSet()) {
            throw new ConfigurationException(
                'A base configuration file was not able to be loaded, or was empty: '.$baseConfigFile
            );
        }
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getAppRoot()
     */
    public function getAppRoot(): string
    {
        return realpath($this->config[ConfigurationInterface::KEY_APP_ROOT]);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getConfigRoot()
     */
    public function getConfigRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->config[ConfigurationInterface::KEY_CONFIG_ROOT];
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getContentRoot()
     */
    public function getContentRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->config[ConfigurationInterface::KEY_CONTENT_ROOT];
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getCacheRoot()
     */
    public function getCacheRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->config[ConfigurationInterface::KEY_CACHE_ROOT];
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\ConfigurationInterface::getThemesRoot()
     */
    public function getThemesRoot(): string
    {
        return $this->getAppRoot().Constants::DS.$this->config[ConfigurationInterface::KEY_THEMES_ROOT];
    }

    /**
     * Return the value associated with the given <code>key</code>.
     * @param string $key The key whose associated value is to be returned.
     * @return mixed Returns the value, otherwise <code>false</code> if the key does not exist.
     */
    final protected function getConfigValue(string $key)
    {
        $retval = false;

        if (isset($this->config[$key], $this->config[$key][ConfigurationInterface::KEY_VALUE])) {
            $retval = $this->config[$key][ConfigurationInterface::KEY_VALUE];
        } elseif (isset($this->config[$key])) {
            $retval = $this->config[$key];
        }

        return $retval;
    }

    /**
     * Returns an array value.
     * @param string $key
     * @return array
     */
    final protected function getArrayValue(string $key): array
    {
        $value = $this->getConfigValue($key);
        if (!$value || !is_array($value)) {
            return [];
        }

        return $value;
    }

    /**
     * Returns an integer (int) value.
     * @param string $key
     * @param int $default The default default is -9999
     * @return int
     */
    final protected function getIntegerValue(string $key, int $default = -9999): int
    {
        $value = $this->getConfigValue($key);
        if (!$value) {
            return $default;
        }

        return intval($value);
    }

    /**
     * Retrieves a string configuration parameter.
     * @param string $key The for the value.
     * @param string $default The default value if not found (empty string)
     * @return string The value.
     */
    final protected function getStringValue(string $key, string $default = ''): string
    {
        $value = $this->getConfigValue($key);
        if (!$value) {
            return $default;
        }

        return strval($value);
    }

    /**
     * Retrieves a boolean configuration parameter.
     * @param string $key The key for the value.
     * @param bool $default The default value if not found (false)
     * @return bool The value
     */
    final protected function getBooleanValue(string $key, bool $default = false): bool
    {
        $value = $this->getConfigValue($key);
        if (!$value) {
            return $default;
        }

        return boolval($value);
    }

    /**
     * Checks that all the mandatory properties are set.
     * @return bool Return <code>true</code> if all the properties are set, otherwise <code>false</code>.
     */
    private function isBaseConfigPropertiesSet(): bool
    {
        return isset(
            $this->config[ConfigurationInterface::KEY_APP_ROOT],
            $this->config[ConfigurationInterface::KEY_CONFIG_ROOT],
            $this->config[ConfigurationInterface::KEY_CACHE_ROOT],
            $this->config[ConfigurationInterface::KEY_THEMES_ROOT],
            $this->config[ConfigurationInterface::KEY_CONTENT_ROOT]
        );
    }
}
