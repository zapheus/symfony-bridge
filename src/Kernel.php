<?php

namespace Zapheus\Bridge\Symfony;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel as HttpKernel;
use Zapheus\Provider\ConfigurationInterface;

/**
 * Kernel
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Kernel extends HttpKernel
{
    /**
     * @var \Zapheus\Provider\ConfigurationInterface
     */
    protected $configuration;

    /**
     * @var \Symfony\Component\HttpKernel\Bundle\BundleInterface[]
     */
    protected $items = array();

    /**
     * Initializes the kernel instance.
     *
     * @param \Symfony\Component\HttpKernel\Bundle\BundleInterface[] $bundles
     * @param \Zapheus\Provider\ConfigurationInterface               $configuration
     */
    public function __construct(array $bundles, ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;

        $parameters = $configuration->get('symfony', array(), true);

        $parameters = $this->defaults((array) $parameters);

        $this->debug = (boolean) $parameters['kernel.debug'];

        $this->environment = $parameters['kernel.environment'];

        $this->rootDir = $parameters['kernel.root_dir'];

        $this->name = $parameters['kernel.name'];

        $this->debug && $this->startTime = microtime(true);

        $this->items = $bundles;
    }

    /**
     * Returns an array of bundles to register.
     *
     * @return \Symfony\Component\HttpKernel\Bundle\BundleInterface[]
     */
    public function registerBundles()
    {
        return (array) $this->items;
    }

    /**
     * Loads the container configuration.
     *
     * @param  \Symfony\Component\Config\Loader\LoaderInterface $loader
     * @return void
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $configuration = $this->configuration;

        $loader->load(function ($container) use ($configuration) {
            $items = $configuration->get('symfony', array(), true);

            foreach ((array) $items as $key => $value) {
                $exists = $container->hasParameter($key) === true;

                $exists || $container->setParameter($key, $value);
            }
        });
    }

    /**
     * Returns an array of default kernel parameters.
     *
     * @param  array $config
     * @return array
     */
    protected function defaults(array $config)
    {
        $items = array('kernel.debug' => true);

        $items['kernel.environment'] = 'dev';

        $items['kernel.root_dir'] = $this->getRootDir();

        $items['kernel.name'] = $this->getName();

        foreach ((array) $items as $key => $value) {
            $exists = isset($config[$key]);

            $exists || $config[$key] = $value;
        }

        return $config;
    }
}
