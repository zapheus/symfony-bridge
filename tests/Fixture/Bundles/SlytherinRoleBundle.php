<?php

namespace Zapheus\Bridge\Symfony\Fixture\Bundles;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Slytherin Role Bundle
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class SlytherinRoleBundle extends Bundle
{
    /**
     * Builds the bundle.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $role = 'Zapheus\Bridge\Symfony\Fixture\Controllers\RoleController';

        $container->register('role', $role);
    }
}
