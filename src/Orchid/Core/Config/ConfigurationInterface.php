<?php declare(strict_types = 1);

namespace Orchid\Core\Config;

/**
 * The platform's core configuration interface.
 * @author Marc L. Veary
 * @namespace Orchid\Core\Config
 */
interface ConfigurationInterface
{
    public const KEY_APP_ROOT = 'appRoot';

    public const KEY_CONFIG_ROOT = 'configRoot';

    public const KEY_CONTENT_ROOT = 'contentRoot';

    public const KEY_CACHE_ROOT = 'cacheRoot';

    public const KEY_THEMES_ROOT = 'themesRoot';

    /**
     * Retrieves the platform's root directory.
     * @return string
     */
    public function getAppRoot(): string;

    /**
     * Retrieves the platform's content directory.
     * @return string
     */
    public function getContentRoot(): string;

    /**
     * Retrieves the platform's config directory.
     * @return string
     */
    public function getConfigRoot(): string;

    /**
     * Retrieves the platform's cache directory.
     * @return string
     */
    public function getCacheRoot(): string;

    /**
     * Retrieves the platform's themes directory.
     * @return string
     */
    public function getThemesRoot(): string;
}
