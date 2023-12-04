<?php
declare(strict_types=1);

namespace Grafikart\Event\Subscriber;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @SubscriberInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event\Subscriber
 */
interface SubscriberInterface
{
      public function getEvents(): array;
}