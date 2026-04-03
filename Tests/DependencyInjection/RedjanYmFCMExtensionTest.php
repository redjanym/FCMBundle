<?php

namespace RedjanYm\FCMBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use RedjanYm\FCM\Client;
use RedjanYm\FCMBundle\DependencyInjection\RedjanYmFCMExtension;
use RedjanYm\FCMBundle\NotificationFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RedjanYmFCMExtensionTest extends TestCase
{
    public function testLoadRegistersServicesAndParameters(): void
    {
        $container = new ContainerBuilder();
        $extension = new RedjanYmFCMExtension();

        $extension->load([
            ['service_account_file' => '/path/to/service-account.json'],
        ], $container);

        $this->assertTrue($container->hasParameter('redjan_ym_fcm.service_account_file'));
        $this->assertSame('/path/to/service-account.json', $container->getParameter('redjan_ym_fcm.service_account_file'));

        $this->assertTrue($container->hasDefinition('redjan_ym_fcm.client'));
        $this->assertTrue($container->hasDefinition('redjan_ym_fcm.notification_factory'));
    }

    public function testClientServiceIsPublic(): void
    {
        $container = new ContainerBuilder();
        $extension = new RedjanYmFCMExtension();

        $extension->load([
            ['service_account_file' => '/path/to/file.json'],
        ], $container);

        $this->assertTrue($container->getDefinition('redjan_ym_fcm.client')->isPublic());
    }

    public function testNotificationFactoryServiceIsPublic(): void
    {
        $container = new ContainerBuilder();
        $extension = new RedjanYmFCMExtension();

        $extension->load([
            ['service_account_file' => '/path/to/file.json'],
        ], $container);

        $definition = $container->getDefinition('redjan_ym_fcm.notification_factory');
        $this->assertTrue($definition->isPublic());
        $this->assertSame('RedjanYm\\FCMBundle\\NotificationFactory', $definition->getClass());
    }

    public function testAutowiringAliases(): void
    {
        $container = new ContainerBuilder();
        $extension = new RedjanYmFCMExtension();

        $extension->load([
            ['service_account_file' => '/path/to/file.json'],
        ], $container);

        $this->assertTrue($container->hasAlias(Client::class));
        $this->assertSame('redjan_ym_fcm.client', (string) $container->getAlias(Client::class));

        $this->assertTrue($container->hasAlias(NotificationFactory::class));
        $this->assertSame('redjan_ym_fcm.notification_factory', (string) $container->getAlias(NotificationFactory::class));
    }
}
