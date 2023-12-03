<?php
declare(strict_types=1);

namespace Grafikart\Event\Dispatcher;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Listener
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event\Dispatcher
 */
class Listener
{

       /**
        * L' evenement appelable
        *
        * @var callable
       */
       public $callback;


       /**
        * Definit la priorite d' appelle d' evenement
        *
        * @var int
       */
       public int $priority;



       /**
        * Definit si le listener peut etre appele plusieurs fois
        *
        * @var bool
       */
       protected bool $once = false;


       /**
        * Permet de savoir combien de fois si le listener a ete appele
        *
        * @var int
       */
       protected int $calls = 0;



       /**
        * Permet de stopper les evenements parents
        *
        * @var bool
       */
       public bool $stopPropagation = false;



       /**
        * @param callable $callback
        *
        * @param int $priority
       */
       public function __construct(callable $callback, int $priority)
       {
           $this->callback = $callback;
           $this->priority = $priority;
       }




       /**
        * @param array $args
        * @return mixed
       */
       public function handle(array $args): mixed
       {
            if ($this->once && $this->calls > 0) {
                return null;
            }

            $this->calls++;
            return call_user_func_array($this->callback, $args);
       }





       /**
        * Permet d' indiquer que le listener peut etre appelle une seule fois
        *
        * @return $this
       */
       public function once(): static
       {
           $this->once = true;

           return $this;
       }




       /**
        * Permet de stopper la propagation des evenements suivants
        *
        * @return $this
       */
       public function stopPropagation(): static
       {
           $this->stopPropagation = true;

           return $this;
       }
}