<?php declare(strict_types = 1);

namespace Orchid\Platform\Config;

final class Configuration extends ConfigurationAbstract
{
    public function __construct(string $baseConfigFile = '', string $appConfigFile = '')
    {
        parent::__construct($baseConfigFile);
    }
}
