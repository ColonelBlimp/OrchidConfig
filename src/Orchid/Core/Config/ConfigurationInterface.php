<?php declare(strict_types = 1);

namespace Orchid\Core\Config;

interface ConfigurationInterface
{
    public const KEY_APP_ROOT = 'appRoot';

    public const KEY_CONFIG_ROOT = 'configRoot';

    public const KEY_CONTENT_ROOT = 'contentRoot';

    /**
     * Retrieves the application's root directory.
     * @return string
     */
    public function getAppRoot(): string;

    /**
     * Retrieves the application's content directory.
     * @return string
     */
    public function getContentRoot(): string;

    /**
     * Retrieves the application's config directory.
     * @return string
     */
    public function getConfigRoot(): string;
}
