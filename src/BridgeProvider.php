<?php

namespace Zapheus\Bridge\Symfony;

use Zapheus\Container\WritableInterface;
use Zapheus\Provider\ProviderInterface;

/**
 * Bridge Provider
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class BridgeProvider implements ProviderInterface
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

        $kernel = new ZapheusKernel($this->bundles, $configuration);

        $kernel->boot();

        $result = $kernel->getContainer();

        return $container->set(self::CONTAINER, $result);
    }
}
