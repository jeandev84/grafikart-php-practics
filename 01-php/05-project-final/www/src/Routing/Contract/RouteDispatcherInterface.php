<?php
declare(strict_types=1);

namespace Grafikart\Routing\Contract;


use Grafikart\Routing\Route;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @RouteDispatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing\Contract
 */
interface RouteDispatcherInterface
{
     public function dispatchRoute(Route $route);
}