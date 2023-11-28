<?php
declare(strict_types=1);

namespace Grafikart\Helpers;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @ObjectHelper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Helpers
 */
class ObjectHelper
{
        public static function hydrate(object $object, array $data, array $fields): void
        {
             foreach ($fields as $field) {
                 $method = 'set'. str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
                 $object->$method($data[$field]);
             }
        }
}