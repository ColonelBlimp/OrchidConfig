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
    ],
    PlatformConfigurationInterface::KEY_STATIC_FRONTPAGE => [
        ConfigurationInterface::KEY_VALUE => 'false',
        ConfigurationInterface::KEY_COMMENT => ''
    ],
    PlatformConfigurationInterface::KEY_ITEMS_PER_PAGE => [
        ConfigurationInterface::KEY_VALUE => '3',
        ConfigurationInterface::KEY_COMMENT => ''
    ],
    PlatformConfigurationInterface::KEY_META_TAGS => [
        "google-site-verification" => [
            ConfigurationInterface::KEY_VALUE => '1234567890',
            ConfigurationInterface::KEY_COMMENT => 'Your google site verification code'
        ],
        "msvalidate.01" => [
            ConfigurationInterface::KEY_VALUE => '0987654321',
            ConfigurationInterface::KEY_COMMENT => 'Your Bing site verification code'
        ],
        "apple-mobile-web-app-title" => [
            ConfigurationInterface::KEY_VALUE => 'MyAppleTitle',
            ConfigurationInterface::KEY_COMMENT => 'For iOS users who add us to the page to their Home Screen'
        ]
    ]
];