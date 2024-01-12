<?php
declare(strict_types=1);

namespace App\Http;

/**
 * Parameter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http
 */
class Parameter
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
     * @param string $key
     * @param $value
     * @return $this
    */
    public function set(string $key, $value): static
    {
        $this->params[$key] = $value;

        return $this;
    }


    /**
     * @param string $key
     * @return bool
    */
    public function has(string $key): bool
    {
        return isset($this->params[$key]);
    }


    /**
     * @param string $key
     * @param $default
     * @return mixed
    */
    public function get(string $key, $default = null): mixed
    {
        return $this->params[$key] ?? $default;
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
}