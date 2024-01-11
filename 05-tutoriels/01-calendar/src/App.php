<?php
declare(strict_types=1);

namespace App;

use App\Http\Response;
use App\Http\ServerRequest;

/**
 * App
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App
 */
class App implements \ArrayAccess
{

     /**
      * @var string
     */
     protected static $instance;


     /**
      * @var array
     */
     protected array $bindings = [];




     /**
      * @return static
     */
     public static function instance(): static
     {
         if (is_null(self::$instance)) {
             self::$instance = new self();
         }

         return self::$instance;
     }





    /**
      * @param string $id
      * @param $value
      * @return $this
     */
     public function bind(string $id, $value): static
     {
         $this->bindings[$id] = $value;

         return $this;
     }




     public function has(string $id): bool
     {
         return isset($this->bindings[$id]);
     }




     /**
      * @param string $id
      * @return mixed
      * @throws \Exception
     */
     public function get(string $id): mixed
     {
         if (! $this->has($id)) {
             throw new \Exception("Could not resolve $id");
         }

         $value = $this->bindings[$id];

         if (! is_callable($value)) {
             return $value;
         }

         return call_user_func($value, $this);
     }





     /**
      * @param string $id
      * @return void
     */
     public function remove(string $id): void
     {
         unset($this->bindings[$id]);
     }




    /**
     * @param ServerRequest $request
     * @return void
     * @throws \Exception
    */
    public function run(ServerRequest $request): void
    {
        $kernel = new Kernel($this);
        $response = $kernel->handle($request);
        $response->send();
        $kernel->terminate($request, $response);
    }





    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }





    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
         $this->bind($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
         $this->remove($offset);
    }
}