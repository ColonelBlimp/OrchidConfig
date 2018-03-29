<?php declare(strict_types = 1);

namespace Orchid\Core\Config;

interface ConfigurationInterface
{
    /**
     * Retrieves the application's root directory.
     * @return string
     */
    public function getAppRoot(): string;
}
