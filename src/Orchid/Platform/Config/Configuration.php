<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

use Orchid\Core\Config\PlatformConfigurationInterface;
use Orchid\Core\Exception\ConfigurationException;

/**
 * @author Marc L. Veary
 * @namespace Orchid\Platform\Config
 * @package Orchid
 */
final class Configuration extends ConfigurationAbstract implements PlatformConfigurationInterface
{
    /**
     * Constructor.
     * @param string $baseConfigFile
     * @param string $platformConfigFile
     * @throws ConfigurationException
     */
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

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getMetaTags()
     */
    public function getMetaTags(): array
    {
        return $this->getArrayValue(PlatformConfigurationInterface::KEY_META_TAGS);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getSocialLinks()
     */
    public function getSocialLinks(): array
    {
        return $this->getArrayValue(PlatformConfigurationInterface::KEY_SOCIAL_LINKS);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getAdminRoot()
     */
    public function getAdminRoot(): string
    {
        return $this->getStringValue(PlatformConfigurationInterface::KEY_ADMIN_CONTEXT, '/admin');
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getDescriptionLength()
     */
    public function getDescriptionLength(): int
    {
        return $this->getIntegerValue(PlatformConfigurationInterface::KEY_META_DESCRIPTION_LENGTH, 150);
    }

    /**
     * {@inheritDoc}
     * @see \Orchid\Core\Config\PlatformConfigurationInterface::getLayoutFilename()
     */
    public function getLayoutFilename(): string
    {
        return $this->getStringValue(PlatformConfigurationInterface::KEY_LAYOUT_FILENAME, 'layout.html.php');
    }
}
