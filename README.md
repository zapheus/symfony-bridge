# Symfony Bundle Bridge

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Converts [Symfony Bundles](https://symfony.com/doc/current/bundles.html) to [Zapheus](https://github.com/zapheus/zapheus) providers.

## Installation

Install `Symfony Bridge` via [Composer](https://getcomposer.org/):

``` bash
$ composer require zapheus/symfony-bridge
```

## Basic Usage

``` php
use Acme\Bundles\AcmeAuthBundle;
use Acme\Bundles\AcmeRoleBundle;
use Zapheus\Bridge\Symfony\BridgeProvider;
use Zapheus\Container\Container;

$bundles = array(new AcmeRoleBundle, new AcmeAuthBundle);

$provider = new Provider((array) $bundles);

$container = $provider->register(new Container);

$symfony = $container->get(BridgeProvider::CONTAINER);
```

## Changelog

Please see [CHANGELOG][link-changelog] for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Credits

- [All contributors][link-contributors]

## License

The MIT License (MIT). Please see [LICENSE][link-license] for more information.

[ico-code-quality]: https://img.shields.io/scrutinizer/g/zapheus/symfony-bridge.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zapheus/symfony-bridge.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/zapheus/symfony-bridge.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zapheus/symfony-bridge/master.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/zapheus/symfony-bridge.svg?style=flat-square

[link-changelog]: https://github.com/zapheus/symfony-bridge/blob/master/CHANGELOG.md
[link-code-quality]: https://scrutinizer-ci.com/g/zapheus/symfony-bridge
[link-contributors]: https://github.com/zapheus/symfony-bridge/contributors
[link-downloads]: https://packagist.org/packages/zapheus/symfony-bridge
[link-license]: https://github.com/zapheus/symfony-bridge/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/zapheus/symfony-bridge
[link-scrutinizer]: https://scrutinizer-ci.com/g/zapheus/symfony-bridge/code-structure
[link-travis]: https://travis-ci.org/zapheus/symfony-bridge