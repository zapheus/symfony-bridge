<?php

namespace Zapheus\Bridge\Symfony;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Zapheus\Bridge\Symfony\Kernel;
use Zapheus\Container\WritableInterface;
use Zapheus\Provider\ProviderInterface;

/**
 * Provider
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Provider implements ProviderInterface
{
    const CONTAINER = 'Symfony\Component\DependencyInjection\Container';

    /**
     * @var \Symfony\Component\HttpKernel\Bundle\BundleInterface[]
     */
    protected $bundles;

    /**
     * Initializes the provider instance.
     *
     * @param \Symfony\Component\HttpKernel\Bundle\BundleInterface[] $bundles
     */
    public function __construct(array $bundles)
    {
        $this->bundles = $bundles;
    }

    /**
     * Registers the bindings in the container.
     *
     * @param  \Zapheus\Container\WritableInterface $container
     * @return \Zapheus\Container\ContainerInterface
     */
    public function register(WritableInterface $container)
    {
        $configuration = $container->get(ProviderInterface::CONFIG);

        $kernel = new Kernel($this->bundles, $configuration);

        $kernel->boot();

        $result = $kernel->getContainer();

        return $container->set(self::CONTAINER, $result);
    }
}
