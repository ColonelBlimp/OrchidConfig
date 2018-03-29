<?php declare(strict_types = 1);

use Orchid\Constants;
use Orchid\Platform\Config\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @expectedException Orchid\Core\Exception\ConfigurationException
     */
    public function testConfigurationExceptionNoFiles()
    {
        $config = new Configuration();
    }

    public function testConfigurationDefault()
    {
        $src = __DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.Constants::FILE_BASE_CONFIG_PHP;
        $dest = getcwd().DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Orchid'.DIRECTORY_SEPARATOR.
        'Platform'.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.Constants::FILE_BASE_CONFIG_PHP;
        copy($src, $dest);

        $config = new Configuration();
        $this->assertSame(realpath('.'), $config->getAppRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'config', $config->getConfigRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'content', $config->getContentRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'cache', $config->getCacheRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'themes', $config->getThemesRoot());

        unlink($dest);
    }

    public function testBaseConfigLoad()
    {
        $config = new Configuration(__DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.'baseConfig.json');
        $this->assertSame(realpath('.'), $config->getAppRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'config', $config->getConfigRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'content', $config->getContentRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'cache', $config->getCacheRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'themes', $config->getThemesRoot());
    }

    public function testPlatformConfigLoad()
    {
        $pathname = getcwd().DIRECTORY_SEPARATOR.'config';
        mkdir($pathname, 0777, true);

        copy(
            __DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.Constants::FILE_PLATFORM_CONFIG_PHP,
            $pathname.DIRECTORY_SEPARATOR.Constants::FILE_PLATFORM_CONFIG_PHP
            );

        $baseConfig = __DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.'baseConfig.json';
        $config = new Configuration($baseConfig);

        unlink($pathname.DIRECTORY_SEPARATOR.Constants::FILE_PLATFORM_CONFIG_PHP);
        rmdir($pathname);
    }
}
