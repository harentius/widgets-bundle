<?php

namespace Harentius\WidgetsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('harentius_widgets');

        $rootNode
            ->children()
                ->arrayNode('routes')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                            ->arrayNode('parameters')
                                ->defaultValue([])
                                ->prototype('array')
                                    ->children()
                                        ->arrayNode('source')
                                        ->isRequired()
                                            ->children()
                                                ->scalarNode('class')->isRequired()->end()
                                                ->scalarNode('field')->isRequired()->end()
                                                ->scalarNode('identity')->isRequired()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('widgets')
                    ->prototype('scalar')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
