<?php
declare(strict_types=1);

namespace Grafikart\Container\Provider;


use Grafikart\Container\Container;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @ServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Container\Provider
 */
abstract class ServiceProvider
{
       abstract public function register(Container $container): void;
}