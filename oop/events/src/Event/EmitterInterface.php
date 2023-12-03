<?php
declare(strict_types=1);

namespace Grafikart\Event;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @EmitterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event
 */
interface EmitterInterface
{
     public function emit($name, $callable): mixed;
}