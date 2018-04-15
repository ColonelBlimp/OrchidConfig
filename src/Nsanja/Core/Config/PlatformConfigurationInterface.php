<?php declare(strict_types = 1);

namespace Nsanja\Core\Config;

/**
 * @author Marc L. Veary
 * @namespace Nsanja\Core\Config
 * @package Nsanja
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
     * The configuration key for the site title.
     */
    public const KEY_SITE_TITLE = 'site.title';

    /**
     * The configuration key for the site description.
     */
    public const KEY_SITE_DESCRIPTION = 'site.description';

    /**
     * The configuration key for the site copyright.
     */
    public const KEY_SITE_COPYRIGHT = 'site.copyright';

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
     * The configuration key for the HTML meta tags.
     */
    public const KEY_META_TAGS = 'meta.tags';

    /**
     * The configuration key for social links.
     */
    public const KEY_SOCIAL_LINKS = 'social.links';

    /**
     * The configuration key for the admin GUI's root context.
     */
    public const KEY_ADMIN_CONTEXT = 'admin.context';

    /**
     * THe configuration key for the maximum number of characters in the meta description tag.
     */
    public const KEY_META_DESCRIPTION_LENGTH = 'description.length';

    /**
     * The configuration key for the main layout filename.
     */
    public const KEY_LAYOUT_FILENAME = 'layout.filename';

    /**
     * Retrieves the site url (site.url). If this is not configure, the method will try to work out the url
     * from the $_SERVER variable.
     * @return string
     */
    public function getSiteUrl(): string;

    /**
     * Retrieves the site title.
     * @return string
     */
    public function getSiteTitle(): string;

    /**
     * Retrieves the site description.
     * @return string
     */
    public function getSiteDescription(): string;

    /**
     * Retrieves the site copyright.
     * @return string
     */
    public function getSiteCopyright(): string;

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

    /**
     * Retrieves a list (array) of configured HTML meta tags to be added to each page.
     */
    public function getMetaTags(): array;

    /**
     * Retrieves a list (array) of configured social links.
     * @return array
     */
    public function getSocialLinks(): array;

    /**
     * Retrieves the root context for the administration GUI.
     * @return string The default is <code>/admin</code>.
     */
    public function getAdminRoot(): string;

    /**
     * Retrieves the maximum length of the meta description tag.
     * @return int Default is 150.
     */
    public function getDescriptionLength(): int;

    /**
     * Retrieves the name of the main layout file.
     */
    public function getLayoutFilename(): string;
}
