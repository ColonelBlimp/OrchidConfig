<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

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
            $url = $scheme.'://'.$server;
        }

        return $url;
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getTheme()
     */
    public function getTheme(): string
    {
        return $this->getStringValue(PlatformConfigurationInterface::KEY_SITE_THEME, 'default');
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getItemsPerPage()
     */
    public function getItemsPerPage(): int
    {
        return $this->getIntegerValue(PlatformConfigurationInterface::KEY_ITEMS_PER_PAGE, 5);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::hasStaticFrontPage()
     */
    public function hasStaticFrontPage(): bool
    {
        return $this->getBooleanValue(PlatformConfigurationInterface::KEY_STATIC_FRONTPAGE);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::isBlogEnabled()
     */
    public function isBlogEnabled(): bool
    {
        return $this->getBooleanValue(PlatformConfigurationInterface::KEY_BLOG_ENABLED, true);
    }
}
