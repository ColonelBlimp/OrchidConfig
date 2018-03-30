<?php declare(strict_types = 1);

namespace Orchid\Core\Config;

/**
 * @author Marc L. Veary
 * @namespace Orchid\Core\Config
 */
interface PlatformConfigurationInterface
{
    /**
     * The filename for the default platform configuration file (PlatformConfig.php). The default location for this
     * file is in the [app_root]/config directory.
     */
    public const FILE_PLATFORM_CONFIG_PHP = 'PlatformConfig.php';

    /**
     * The site url [protocol][FQDN]
     */
    public const KEY_SITE_URL = 'site.url';

    /**
     * The theme the site is currently using.
     */
    public const KEY_SITE_THEME = 'site.theme';

    /**
     * Retrieves the site url (site.url). If this is not configure, the method will try to work out the url
     * from the $_SERVER variable.
     * @return string
     */
    public function getSiteUrl(): string;

    /**
     * Retrieves the theme to use (site.theme). This is the name of a directory under the directory name returned by
     * the <code>getThemesRoot()</code> method.
     * @see ConfigurationInterface::getThemesRoot()
     * @return string
     */
    public function getTheme(): string;
}
