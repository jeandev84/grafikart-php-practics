<?php
declare(strict_types=1);

namespace ZFramework\Routing;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @Route Represent matched route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package ZFramework\Routing
 */
class Route
{


    private string $name;

    /**
     * @var callable
     */
    private $callback;


    private array $parameters;



    public function __construct(
        string $name,
        callable $callback,
        array $parameters
    )
    {

        $this->name = $name;
        $this->callback = $callback;
        $this->parameters = $parameters;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return callable
     */
    public function getCallback(): callable
    {
       return $this->callback;
    }


    /**
     * Returns the URL parameters
     *
     * @return array
    */
    public function getParams(): array
    {
         return $this->parameters;
    }
}