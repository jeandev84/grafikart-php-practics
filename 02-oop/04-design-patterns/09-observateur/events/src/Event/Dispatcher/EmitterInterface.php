<?php
declare(strict_types=1);

namespace Grafikart\Event\Dispatcher;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @EmitterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event\Dispatcher
 */
interface EmitterInterface
{
     public function on(string $event, callable $callable, int $priority = 0): mixed;

     public function emit(string $event, ...$args): mixed;
}