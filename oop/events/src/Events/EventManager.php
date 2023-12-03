<?php
declare(strict_types=1);

namespace Grafikart\Events;


use Grafikart\Psr\EventInterface;
use Grafikart\Psr\EventManagerInterface;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @EventManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Events
 */
class EventManager implements EventManagerInterface
{


    protected array $listeners = [];



    /**
     * @inheritDoc
     */
    public function attach($event, $callback, $priority = 0): bool
    {
         $this->listeners[$event][] = compact('callback', 'priority');

         return true;
    }





    /**
     * @inheritDoc
     */
    public function detach($event, $callback): bool
    {
        $this->listeners[$event] = array_filter($this->listeners[$event], function ($listener) use ($callback) {
             return $listener['callback'] !== $callback;
        });

        return true;
    }




    /**
     * @inheritDoc
     */
    public function clearListeners($event)
    {
        $this->listeners[$event] = [];
    }



    /**
     * @inheritDoc
     */
    public function trigger($event, $target = null, $argv = [])
    {
         if (is_string($event)) {
             $event  = $this->makeEvent($event, $target, $argv);
         }

         if (isset($this->listeners[$event->getName()])) {
              $listeners = $this->listeners[$event->getName()];
              usort($listeners, function ($listenerA, $listenerB) {
                   return $listenerB['priority'] - $listenerA['priority'];
              });
              foreach ($listeners as ['callback' => $callback]) {
                   if ($event->isPropagationStopped()) {
                        break;
                   }
                   call_user_func($callback, $event);
              }
         }
    }


    /**
     * @param string $eventName
     * @param $target
     * @param array $argv
     * @return EventInterface
     */
    private function makeEvent(string $eventName, $target, array $argv = []): EventInterface
    {
          $event = new Event();
          $event->setName($eventName);
          $event->setTarget($target);
          $event->setParams($argv);
          return $event;
    }
}