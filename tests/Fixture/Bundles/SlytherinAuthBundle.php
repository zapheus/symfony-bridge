<?php

namespace Zapheus\Bridge\Symfony\Fixture\Bundles;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Slytherin Auth Bundle
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class SlytherinAuthBundle extends Bundle
{
    /**
     * Builds the bundle.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $auth = 'Zapheus\Bridge\Symfony\Fixture\Controllers\AuthController';

        $definition = new Definition($auth, array(new Reference('role')));

        $container->setDefinition('auth', $definition);
    }
}
