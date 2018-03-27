<?php declare(strict_types = 1);

use Orchid\Platform\Config\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @expectedException Orchid\Core\Exception\ConfigurationException
     */
    public function testBaseConfig()
    {
        $config = new Configuration();
    }
}
