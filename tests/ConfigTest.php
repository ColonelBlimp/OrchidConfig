<?php declare(strict_types = 1);

use Orchid\Core\Config\ConfigurationInterface;
use Orchid\Core\Config\PlatformConfigurationInterface;
use Orchid\Core\Exception\ConfigurationException;
use Orchid\Platform\Config\Configuration;
use PHPUnit\Framework\TestCase;

define('DS', DIRECTORY_SEPARATOR);

class ConfigTest extends TestCase
{
    /**
     * @expectedException Orchid\Core\Exception\ConfigurationException
     * @expectedExceptionMessage A base configuration file was not able to be loaded, or was empty:
     */
    public function testBaseConfigurationExceptionNoFiles()
    {
        $config = new Configuration('', '');
    }

    /**
     * @expectedException Orchid\Core\Exception\ConfigurationException
     * @expectedExceptionMessage A platform configuration file was not able to be loaded, or was empty:
     */
    public function testPlatformConfigurationExceptionNoFiles()
    {
        $base = $this->loadBaseConfiguration();
        try {
            $config = new Configuration($base, '');
        } catch (ConfigurationException $cex) {
            $this->removeBaseConfiguration($base);
            throw $cex;
        }
    }

    public function testBaseConfigLoad()
    {
        $base = $this->loadBaseConfiguration();
        $platform = $this->loadPlatformConfiguration();

        $config = new Configuration($base, $platform);
        $this->assertSame(realpath('.'), $config->getAppRoot());
        $this->assertSame(realpath('.').DS.'config', $config->getConfigRoot());
        $this->assertSame(realpath('.').DS.'content', $config->getContentRoot());
        $this->assertSame(realpath('.').DS.'cache', $config->getCacheRoot());
        $this->assertSame(realpath('.').DS.'themes', $config->getThemesRoot());

        $this->removePlatformConfiguration($platform);
        $this->removeBaseConfiguration($base);
    }

    private function loadBaseConfiguration(string $filename = ConfigurationInterface::FILE_BASE_CONFIG_PHP): string
    {
        $src = __DIR__.DS.'_files'.DS.$filename;
        $dest = getcwd().DS.'src'.DS.'Orchid'.DS.'Platform'.DS.'Config'.DS.$filename;
        copy($src, $dest);
        return $dest;
    }

    private function loadPlatformConfiguration(string $filename = PlatformConfigurationInterface::FILE_PLATFORM_CONFIG_PHP): string
    {
        $src = __DIR__.DS.'_files'.DS.$filename;
        $dest = getcwd().DS.'config';
        mkdir($dest, 0777, true);
        $dest .= DS.$filename;
        copy($src, $dest);
        return $dest;
    }

    private function removeBaseConfiguration(string $filename)
    {
        unlink($filename);
    }

    private function removePlatformConfiguration(string $filename)
    {
        unlink($filename);
        rmdir(getcwd().DS.'config');
    }
}
