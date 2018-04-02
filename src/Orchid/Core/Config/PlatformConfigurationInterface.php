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
     * The configuration key for the site url [protocol][FQDN]
     */
    public const KEY_SITE_URL = 'site.url';

    /**
     * The configuration key for the theme the site is currently using.
     */
    public const KEY_SITE_THEME = 'site.theme';

    /**
     * The configuration key for the maximum number of items per page.
     */
    public const KEY_ITEMS_PER_PAGE = 'items.perpage';

    /**
     * The configuration key for enabling a static front page.
     */
    public const KEY_STATIC_FRONTPAGE = 'static.frontpage';

    /**
     * The configuration key for enabling/disabling the /blog URI
     */
    public const KEY_BLOG_ENABLED = 'blog.enabled';

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

    /**
     * Retrieves the maximum number of items to be displayed per page (i.e. before pagination is needed).
     * @return int The default is 5.
     */
    public function getItemsPerPage(): int;

    /**
     * Does the site have a static front page?
     * @return bool
     */
    public function hasStaticFrontPage(): bool;

    /**
     * Is the /blog URI enabled?
     * @return bool
     */
    public function isBlogEnabled(): bool;
}
