<?php

namespace Zapheus\Bridge\Symfony;

use Zapheus\Bridge\Symfony\Fixture\Bundles\SlytherinAuthBundle;
use Zapheus\Bridge\Symfony\Fixture\Bundles\SlytherinRoleBundle;
use Zapheus\Container\Container;
use Zapheus\Provider\Configuration;

/**
 * Bridge Provider Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class BridgeProviderTest extends \PHPUnit_Framework_TestCase
{
    const AUTH_CONTROLLER = 'Zapheus\Bridge\Symfony\Fixture\Controllers\AuthController';

    /**
     * @var \Zapheus\Container\WritableInterface
     */
    protected $container;

    /**
     * @var \Zapheus\Provider\FrameworkProvider
     */
    protected $framework;

    /**
     * Sets up the provider instance.
     *
     * @return void
     */
    public function setUp()
    {
        $root = __DIR__ . '/Fixture';

        $config = new Configuration;

        $this->clear($root . '/Symfony/cache');

        $this->clear($root . '/Symfony/logs');

        $config->set('symfony.kernel.secret', 'secret');

        $config->set('symfony.kernel.debug', true);

        $config->set('symfony.kernel.root_dir', $root . '/Symfony');

        $config->set('symfony.kernel.environment', 'dev');

        $config->set('symfony.kernel.project_dir', $root);

        $this->container = new Container;

        $this->container->set(BridgeProvider::CONFIG, $config);
    }

    /**
     * Tests ProviderInterface::register.
     *
     * @return void
     */
    public function testRegisterMethod()
    {
        $bundles = array(new SlytherinRoleBundle, new SlytherinAuthBundle);

        $provider = new BridgeProvider((array) $bundles);

        $container = $provider->register($this->container);

        $container = $container->get(BridgeProvider::CONTAINER);

        $expected = (string) self::AUTH_CONTROLLER;

        $result = $container->get('auth');

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Deletes the directory recursively.
     *
     * @param  string $target
     * @return void
     */
    protected function clear($target)
    {
        if (is_dir($target) === true) {
            // GLOB_MARK adds a slash to directories returned
            $files = glob($target . '*', GLOB_MARK);

            foreach ($files as $file) {
                $this->clear($file);
            }

            return file_exists($target) && rmdir($target);
        }

        file_exists($target) && unlink($target);
    }
}
