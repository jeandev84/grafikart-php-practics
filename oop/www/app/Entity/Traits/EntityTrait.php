<?php
declare(strict_types=1);

namespace App\Entity\Traits;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @EntityTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\Traits
 */
trait EntityTrait
{
    public function __get(string $name)
    {
        $method = sprintf('get%s', ucfirst($name));

        return $this->{$name} = $this->{$method}();
    }
}