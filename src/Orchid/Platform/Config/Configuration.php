<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

use Orchid\Constants;
use Orchid\Core\Config\PlatformConfigurationInterface;
use Orchid\Core\Exception\ConfigurationException;

/**
 * @author Marc L. Veary
 * @namespace Orchid\Platform\Config
 */
final class Configuration extends ConfigurationAbstract implements PlatformConfigurationInterface
{
    public function __construct(string $baseConfigFile, string $platformConfigFile)
    {
        parent::__construct($baseConfigFile);

        $config = [];
        if (is_readable($platformConfigFile)) {
            $config = include $platformConfigFile;
        }

        if (empty($config)) {
            throw new ConfigurationException(
                'A platform configuration file was not able to be loaded, or was empty: '.$platformConfigFile
            );
        }

        $this->config = array_merge($this->config, $config);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getSiteUrl()
     */
    public function getSiteUrl(): string
    {
        $url = $this->getStringValue(PlatformConfigurationInterface::KEY_SITE_URL);

        if (empty($url)) {
            $scheme = filter_input(INPUT_SERVER, 'REQUEST_SCHEME');
            $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
            return $scheme.'://'.$server;
        }

        return $url;
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getTheme()
     */
    public function getTheme(): string
    {
        return $this->getThemesRoot().Constants::DS
        .$this->getStringValue(PlatformConfigurationInterface::KEY_SITE_THEME, 'default');
    }
}
