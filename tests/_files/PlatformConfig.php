<?php declare(strict_types = 1);

use Orchid\Core\Config\ConfigurationInterface;
use Orchid\Core\Config\PlatformConfigurationInterface;

return [
    PlatformConfigurationInterface::KEY_SITE_URL => [
        ConfigurationInterface::KEY_VALUE => '',
        ConfigurationInterface::KEY_COMMENT => 'Your sites FQDN'
    ],
    PlatformConfigurationInterface::KEY_SITE_THEME => [
        ConfigurationInterface::KEY_VALUE => 'default',
        ConfigurationInterface::KEY_COMMENT => ''
    ]
];