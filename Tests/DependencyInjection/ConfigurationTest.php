<?php

namespace RedjanYm\FCMBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use RedjanYm\FCMBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testValidConfiguration(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), [
            ['service_account_file' => '/path/to/service-account.json'],
        ]);

        $this->assertSame('/path/to/service-account.json', $config['service_account_file']);
    }

    public function testServiceAccountFileIsRequired(): void
    {
        $this->expectException(\Symfony\Component\Config\Definition\Exception\InvalidConfigurationException::class);

        $processor = new Processor();
        $processor->processConfiguration(new Configuration(), [[]]);
    }

    public function testServiceAccountFileCannotBeEmpty(): void
    {
        $this->expectException(\Symfony\Component\Config\Definition\Exception\InvalidConfigurationException::class);

        $processor = new Processor();
        $processor->processConfiguration(new Configuration(), [
            ['service_account_file' => ''],
        ]);
    }
}
