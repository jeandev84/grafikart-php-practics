<?php
declare(strict_types=1);

namespace Grafikart\Http;

/**
 * Parameter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http
 */
class Parameter implements \ArrayAccess
{

    /**
     * @var array
    */
    protected $params = [];


    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        $this->add($params);
    }




    /**
     * @param array $params
     * @return $this
     */
    public function add(array $params): static
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }



    /**
     * @param $key
     * @param $value
     * @return $this
    */
    public function set($key, $value): static
    {
        $this->params[$key] = $value;

        return $this;
    }




    /**
     * @param $key
     * @return bool
    */
    public function has($key): bool
    {
        return isset($this->params[$key]);
    }




    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function get($key, $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }


    /**
     * @param $key
     * @return void
     */
    public function remove($key)
    {
        unset($this->params[$key]);
    }




    /**
     * @return array
    */
    public function all(): array
    {
        return $this->params;
    }




    /**
     * @param string $key
     * @param string $default
     * @return string
    */
    public function escape(string $key, string $default = ''): string
    {
        $value = $this->get($key, $default);

        if ($value === null) {
            return '';
        }

        return htmlentities($value);
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
       $this->set($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }
}