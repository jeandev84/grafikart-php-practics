<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Entity\Traits;


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


    /**
     * @var string
    */
    protected static $tableName;


    /**
     * @param string $name
     *
     * @return mixed
    */
    public function __get(string $name)
    {
        $method = sprintf('get%s', ucfirst($name));

        return $this->{$name} = $this->{$method}();
    }




    /**
     * @return string
    */
    public static function getClassName(): string
    {
         if (! static::$tableName) {
             $className = explode('\\', get_called_class());
             static::$tableName =  strtolower(end($className)). 's';
         }
         return static::$tableName;
    }
}