<?php
declare(strict_types=1);

namespace Grafikart\Http\Bag;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @ParameterBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Bag
 */
class ParameterBag
{
    /**
     * @var array
     */
    protected array $params = [];


    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }




    /**
     * @param array $params
     *
     * @return $this
     */
    public function merge(array $params): self
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }



    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->params[$name]);
    }



    public function all(): array
    {
        return $this->params;
    }



    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null): mixed
    {
        return  $this->params[$name] ?? $default;
    }


    /**
     * @param string $name
     * @param int $default
     * @return int
     */
    public function getInt(string $name, int $default = 0): int
    {
        return (int)$this->get($name, $default);
    }
}