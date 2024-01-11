<?php
declare(strict_types=1);

namespace Framework\Database;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @Hydrator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database
 */
class Hydrator
{
      public static function hydrate(array $array, $object)
      {
           $instance = (is_string($object) ? new $object() : $object);

           foreach ($array as $key => $value) {
               $method = static::getSetter($key);
               if (method_exists($instance, $method)) {
                   $instance->$method($value);
               } else {
                  $property = lcfirst(self::getProperty($key));
                  $instance->$property = $value;
               }
           }
           return $instance;
      }



      private static function getSetter(string $fieldName): string
      {
           return 'set'. self::getProperty($fieldName);
      }



      private static function getProperty(string $fieldName): string
      {
          return join('', array_map('ucfirst', explode('_', $fieldName)));
      }
}