<?php

namespace Zapheus\Bridge\Symfony;

use Zapheus\Bridge\Symfony\Fixture\Bundles\SlytherinAuthBundle;
use Zapheus\Bridge\Symfony\Fixture\Bundles\SlytherinRoleBundle;
use Zapheus\Container\Container;
use Zapheus\Provider\Configuration;
use Zapheus\Provider\FrameworkProvider;

/**
 * Provider Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
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
        $message = 'Symfony Kernel is not yet installed.';

        $kernel = 'Symfony\Component\HttpKernel\Kernel';

        class_exists($kernel) || $this->markTestSkipped($message);

        $config = new Configuration;

        $root = __DIR__ . '/Fixture';

        $this->deleteFiles($root . '/Symfony/cache');

        $this->deleteFiles($root . '/Symfony/logs');

        $config->set('symfony.kernel.debug', true);

        $config->set('symfony.kernel.environment', 'dev');

        $config->set('symfony.kernel.project_dir', $root);

        $config->set('symfony.kernel.root_dir', $root . '/Symfony');

        $config->set('symfony.kernel.secret', 'secret');

        $this->container = new Container;

        $this->container->set(Provider::CONFIG, $config);

        $this->framework = new FrameworkProvider;
    }

    /**
     * Tests ProviderInterface::register.
     *
     * @return void
     */
    public function testRegisterMethod()
    {
        $container = $this->container;

        $role = new Provider(new SlytherinRoleBundle);

        $auth = new Provider(new SlytherinAuthBundle);

        $container = $role->register($container);

        $container = $auth->register($container);

        $container = $this->framework->register($container);

        $expected = 'Zapheus\Bridge\Symfony\Fixture\Controllers\AuthController';

        $result = $container->get('auth');

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Deletes the directory recursively.
     *
     * @param  string $target
     * @return void
     */
    protected function deleteFiles($target)
    {
        if (is_dir($target) === true) {
            // GLOB_MARK adds a slash to directories returned
            $files = glob($target . '*', GLOB_MARK);

            foreach ($files as $file) {
                $this->deleteFiles($file);
            }

            return file_exists($target) && rmdir($target);
        }

        file_exists($target) && unlink($target);
    }
}
