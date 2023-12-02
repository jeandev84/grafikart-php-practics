<?php
declare(strict_types=1);

namespace Grafikart\Database\Builder\Facade;


use Grafikart\Database\Builder\QueryBuilder;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Builder\Facade
 */
class Query
{
       public static function __callStatic(string $method, array $arguments)
       {
            $query = new QueryBuilder();

            return call_user_func_array([$query, $method], $arguments);
       }
}



