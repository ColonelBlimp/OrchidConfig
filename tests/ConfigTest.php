<?php declare(strict_types = 1);

use Orchid\Platform\Config\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @expectedException Orchid\Core\Exception\ConfigurationException
     * @expectedExceptionMessage Unable to locate a base configuration file to load.
     */
    public function testConfigurationExceptionNoFiles()
    {
        $config = new Configuration();
    }

    public function testBaseConfigLoad()
    {
        $config = new Configuration(__DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.'baseConfig.json');
        $this->assertSame(realpath(__DIR__.DIRECTORY_SEPARATOR.'..'), $config->getAppRoot());
    }
}
