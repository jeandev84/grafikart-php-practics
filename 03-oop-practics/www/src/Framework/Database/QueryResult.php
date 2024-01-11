<?php
declare(strict_types=1);

namespace Framework\Database;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @QueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database
 */
class QueryResult implements \ArrayAccess, \Iterator
{

      protected array $records = [];

      protected int $index = 0;
      protected array $hydratedRecords = [];
      protected ?string $entity = null;


      public function __construct(array $records, string $entity = null)
      {
          $this->records = $records;
          $this->entity  = $entity;
      }



     public function get(int $index)
     {
        if ($this->entity) {
            if (! isset($this->hydratedRecords[$index])) {
                $this->hydratedRecords[$index] = Hydrator::hydrate($this->records[$index], $this->entity);
            }
            return $this->hydratedRecords[$index];
        }

        return $this->entity;
    }



    /**
      * @inheritDoc
     */
     public function current(): mixed
     {
         return $this->get($this->index);
     }




    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->index++;
    }





    /**
     * @inheritDoc
     */
    public function key(): mixed
    {
        return $this->index;
    }



    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return isset($this->records[$this->index]);
    }




    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->index = 0;
    }





    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->records[$offset]);
    }



    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->records[$offset];
    }




    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \Exception("Cannot alter records");
    }





    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new \Exception("Cannot alter records");
    }
}