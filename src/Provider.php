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
    const KERNEL = 'Zapheus\Bridge\Symfony\Kernel';

    /**
     * @var \Symfony\Component\HttpKernel\Bundle\BundleInterface
     */
    protected $bundle;

    /**
     * Initializes the provider instance.
     *
     * @param \Symfony\Component\HttpKernel\Bundle\BundleInterface $bundle
     */
    public function __construct(BundleInterface $bundle)
    {
        $this->bundle = $bundle;
    }

    /**
     * Registers the bindings in the container.
     *
     * @param  \Zapheus\Container\WritableInterface $container
     * @return \Zapheus\Container\ContainerInterface
     */
    public function register(WritableInterface $container)
    {
        if ($container->has(self::KERNEL) === true) {
            $kernel = $container->get(self::KERNEL);

            $kernel->add($this->bundle);

            return $container->set(self::KERNEL, $kernel);
        }

        $configuration = $container->get(ProviderInterface::CONFIG);

        $kernel = new Kernel($configuration);

        $kernel->add($this->bundle);

        return $container->set(self::KERNEL, $kernel);
    }
}
