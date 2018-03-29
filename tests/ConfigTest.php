<?php declare(strict_types = 1);

use Orchid\Platform\Config\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigurationExceptionNoFiles()
    {
        $config = new Configuration();
        $this->assertSame(realpath('.'), $config->getAppRoot());
    }

    public function testBaseConfigLoad()
    {
        $config = new Configuration(__DIR__.DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.'baseConfig.json');
        $this->assertSame(realpath('.'), $config->getAppRoot());
    }
}
