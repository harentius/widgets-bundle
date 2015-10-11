<?php

namespace Harentius\WidgetsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class HarentiusWidgetsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $positionType = $container->findDefinition('harentius_widgets.form.type.position');

        foreach ($config['widgets'] as $key => $name) {
            $positionType->addMethodCall('registerPosition', [$key, $name]);
        }

        $routeType = $container->findDefinition('harentius_widgets.form.type.route');
        $routeFieldsType = $container->findDefinition('harentius_widgets.form.type.route_fields');

        foreach ($config['routes'] as $key => $name) {
            $routeType->addMethodCall('registerRoute', [$key, $name]);
            $routeFieldsType->addMethodCall('registerRoute', [$key, $name]);
        }
    }
}
