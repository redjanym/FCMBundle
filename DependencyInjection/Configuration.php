<?php

namespace RedjanYm\FCMBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('redjan_ym_fcm');
        $rootNode = method_exists(TreeBuilder::class, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('redjan_ym_fcm');

        $rootNode
            ->children()
                ->scalarNode('service_account_file')->isRequired()->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
