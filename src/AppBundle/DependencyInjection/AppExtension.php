<?php

namespace AppBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class AppExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('app_services.yml');
        $loader->load('app_repositories.yml');
        $loader->load('app_controllers.yml');
        $loader->load('app_handlers.yml');
        $loader->load('app_form_types.yml');
    }

}