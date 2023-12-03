<?php
declare(strict_types=1);

namespace Grafikart\Event\Dispatcher;


use Grafikart\Event\Exceptions\DoubleEventException;
use Grafikart\Event\Subscriber\SubscriberInterface;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Emitter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event\Dispatcher
 */
class Emitter
{

    /**
     * @var static
    */
    protected static $instance;


    /**
     * Enregistre la liste des ecouteurs
     *
     * @var Listener[]
    */
    protected array $listeners = [];



    /**
     * Retourne une instance d' emitteur
     *
     * @return $this
     */
    public static function getInstance(): static
    {
         if (! self::$instance) {
             self::$instance = new self();
         }
         return self::$instance;
    }





    /**
     * Permet d' ecouter un evenement
     *
     * Enregistre un evenement addListener($event, $callable)
     *
     * @param string $event
     * @param callable $callable
     * @param int $priority
     * @return Listener
     */
    public function on(string $event, callable $callable, int $priority = 0): Listener
    {
        if (! $this->hasListener($event)) {
            $this->listeners[$event] = [];
        }

        $this->callableExistsForEvent($event, $callable);
        
        $listener = new Listener($callable, $priority);
        $this->listeners[$event][] = $listener;
        $this->sortListeners($event);
        return $listener;
    }





    /**
     * Permete d' ecouter un evenement et de lancer le listener une seule fois
     *
     * @param string $event
     *
     * @param callable $callable
     *
     * @param int $priority
     *
     * @return Listener
     */
    public function once(string $event, callable $callable, int $priority = 0): Listener
    {
         return $this->on($event, $callable, $priority)->once();
    }




    public function addSubscriber(SubscriberInterface $subscriber): self
    {

    }




    /**
     * Permet d'envoyer un evenement
     *
     * Dispatcher d' evenement dispatch($event, ...$args)
     *
     * @param string $event
     * @param ...$args
     * @return void
     */
    public function emit(string $event, ...$args)
    {
        if ($this->hasListener($event)) {
            foreach ($this->listeners[$event] as $listener) {
                $listener->handle($args);
                if ($listener->stopPropagation) {
                     break;
                }
            }
        }
    }




    /**
     * @param string $event
     * @return bool
     */
    private function hasListener(string $event): bool
    {
        return array_key_exists($event, $this->listeners);
    }




    /**
     * @param string $event
     *
     * @return void
     */
    private function sortListeners(string $event): void
    {
       uasort($this->listeners[$event], function ($a, $b) {
          return $a->priority < $b->priority;
       });
    }




    private function callableExistsForEvent(string $event, callable $callable): bool
    {
         foreach ($this->listeners[$event] as $listener) {
              if ($listener->callback === $callable) {
                  throw new DoubleEventException();
              }
         }

         return false;
    }
}