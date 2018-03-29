<?php declare(strict_types = 1);

use Orchid\Platform\Config\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigurationExceptionNoFiles()
    {
        $config = new Configuration();
        $this->assertSame(realpath('.'), $config->getAppRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'config', $config->getConfigRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'content', $config->getContentRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'cache', $config->getCacheRoot());
        $this->assertSame(realpath('.').DIRECTORY_SEPARATOR.'themes', $config->getThemesRoot());
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
}
