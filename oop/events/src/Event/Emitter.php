<?php
declare(strict_types=1);

namespace Grafikart\Event;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Emitter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event
 */
class Emitter
{

    /**
     * @var self
    */
    protected static $instance;


    /**
     * Enregistre la liste des ecouteurs
     *
     * @var array
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
                 call_user_func_array($listener, $args);
             }
         }
    }




    /**
     * Permet d' ecouter un evenement
     *
     * Enregistre un evenement addListener($event, $callable)
     *
     * @param string $event
     * @param callable $callable
     * @return $this
     */
    public function on(string $event, callable $callable): static
    {
        if (! $this->hasListener($event)) {
            $this->listeners[$event] = [];
        }

        $this->listeners[$event][] = $callable;

        return $this;
    }



    private function hasListener(string $event): bool
    {
        return array_key_exists($event, $this->listeners);
    }
}